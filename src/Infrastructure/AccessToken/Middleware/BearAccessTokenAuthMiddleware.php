<?php

namespace GuardsmanPanda\LarabearAuth\Infrastructure\AccessToken\Middleware;

use Closure;
use GuardsmanPanda\Larabear\Enum\BearSeverityEnum;
use GuardsmanPanda\Larabear\Infrastructure\Http\Service\Req;
use GuardsmanPanda\Larabear\Infrastructure\Security\Crud\BearSecurityIncidentCreator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class BearAccessTokenAuthMiddleware {
    public static string|null $primary_api_key = null;
    private static string|null $access_token_id = null;

    public function handle(Request $request, Closure $next) {
        if ($request->bearerToken() === null) {
            throw new AccessDeniedHttpException(message: 'The request must include a bearer token.');
        }
        $hashed_access_token = hash(algo: 'xxh128', data: $request->bearerToken());
        $access = DB::selectOne("
            SELECT at.id, at.api_primary_key, at.expires_at
            FROM bear_access_token at
            WHERE
                at.hashed_access_token = ? AND ? <<= at.ip_restriction 
                AND starts_with(?, at.api_route_prefix)
        ", [$hashed_access_token, Req::ip(), Req::path()]);

        //if access token is not valid, abort
        if ($access === null || $access->id === null) {
            $message = 'The supplied access token is not valid.. ip: ' . Req::ip() . ', country: ' . Req::ipCountry() . ', path: ' . Req::path() . ', hostname: '. Req::hostname() . ', hashed_token: ' . $hashed_access_token;
            BearSecurityIncidentCreator::create(
                namespace: 'bear-token-auth',
                severity: BearSeverityEnum::HIGH,
                headline: 'Invalid access token',
                description: $message,
                remediation: 'Check the system making the call, if it is not under your control then consider blacklisting the IP address.',
            );
            throw new AccessDeniedHttpException(message: $message);
        }
        self::$primary_api_key = $access->api_primary_key;
        self::$access_token_id = $access->id;
        return $next($request);
    }

    public function terminate(Request $request, Response $response): void {
        $time = 0;
        if (defined(constant_name: 'LARAVEL_START')) {
            $time = (int)((microtime(as_float: true) - get_defined_constants()['LARAVEL_START']) * 1000);
        }
        DB::insert("
            INSERT INTO bear_access_token_log (request_ip, request_country_code, request_http_method, request_http_path, request_http_query, request_http_hostname, response_status_code, response_body, response_time_in_milliseconds, access_token_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [Req::ip(), Req::ipCountry(), Req::method(), Req::path(), json_encode(Req::allQuery(), JSON_THROW_ON_ERROR), Req::hostname(), $response->getStatusCode(), $response->getStatusCode() >= 400 ? $response->getContent() : null, $time, self::$access_token_id]
        );
    }
}
