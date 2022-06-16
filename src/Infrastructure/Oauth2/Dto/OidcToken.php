<?php

namespace GuardsmanPanda\LarabearAuth\Infrastructure\Oauth2\Dto;

use Carbon\Carbon;
use GuardsmanPanda\Larabear\Enum\BearSeverityEnum;
use GuardsmanPanda\Larabear\Infrastructure\Idempotency\Crud\BearIdempotencyCreator;
use GuardsmanPanda\Larabear\Infrastructure\Security\Crud\BearSecurityIncidentCreator;
use RuntimeException;
use Throwable;

class OidcToken {
    public function __construct(
        public readonly string $userIdentifier,
        public readonly string $email,
        public readonly string $issuedToClientId,
        public readonly int    $notBefore,
        public readonly int    $expiresAt,
        public readonly string $tokenUniqueId,
    ) {}

    public static function fromJwt(string $jwt, string $applicationId): self {
        try {
            $stdClass = json_decode(base64_decode(str_replace('_', '/', str_replace('-', '+', explode('.', $jwt)[1]))), false, 512, JSON_THROW_ON_ERROR);
            if ($applicationId !== $stdClass->aud) {
                BearSecurityIncidentCreator::create(
                    severity: BearSeverityEnum::CRITICAL,
                    namespace: "LarabearAuth",
                    headline: "Incorrect application id in JWT",
                    description: "The application id in the JWT is not the same as the application id on the server. JWT: $stdClass->aud, Server: $applicationId",
                );
                throw new RuntimeException(message: "Incorrect Application ID.");
            }
            $uniq = $stdClass->aud . ':' . $stdClass->jti;
            BearIdempotencyCreator::create(idempotency_key: $uniq);
        } catch (Throwable $t) { //TODO Better error log.
            BearSecurityIncidentCreator::create(
                severity: BearSeverityEnum::CRITICAL,
                namespace: "LarabearAuth",
                headline: "Invalid JWT",
                description: "Error message: {$t->getMessage()}",
            );
            throw new RuntimeException(message: "Token incorrectly formatted or already used.");
        }

        $ts = Carbon::now()->timestamp;
        if ($ts < $stdClass->nbf || $ts > $stdClass->exp) {
            BearSecurityIncidentCreator::create(
                severity: BearSeverityEnum::CRITICAL,
                namespace: "LarabearAuth",
                headline: "Invalid timestamp in JWT",
                description: "The timestamp in the JWT is not valid. JWT: nbf: $stdClass->nbf, exp: $stdClass->exp, ts: $ts",
            );
            throw new RuntimeException(message: "Incorrect Timestamp.");
        }
        return new self(
            userIdentifier: $stdClass->sub,
            email: $stdClass->email,
            issuedToClientId: $stdClass->aud,
            notBefore: $stdClass->nbf,
            expiresAt: $stdClass->exp,
            tokenUniqueId: $stdClass->jti,
        );
    }
}
