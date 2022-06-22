<?php

namespace GuardsmanPanda\LarabearAuth\Infrastructure\Oauth2\Service;

use GuardsmanPanda\LarabearAuth\Infrastructure\Oauth2\Model\BearOauth2Client;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class BearOauth2ClientService {
    public static function exchangeCode(string $code, BearOauth2Client $client, string $redirect_uri): array {
        $resp = Http::asForm()->post($client->oauth2_token_uri, [
            'code' => $code,
            'client_secret' => $client->encrypted_oauth2_client_secret,
            'grant_type' => 'authorization_code',
            'client_id' => $client->oauth2_client_id,
            'redirect_uri' => $redirect_uri,
        ]);
        if ($resp->failed()) {
            throw new RuntimeException($resp->body());
        }
        return $resp->json();
    }
}