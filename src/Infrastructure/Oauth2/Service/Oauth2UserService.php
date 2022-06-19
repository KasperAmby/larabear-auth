<?php

namespace GuardsmanPanda\LarabearAuth\Infrastructure\Oauth2\Service;

use GuardsmanPanda\LarabearAuth\Infrastructure\Oauth2\Dto\OidcToken;
use GuardsmanPanda\LarabearAuth\Infrastructure\Oauth2\Model\BearOauth2Client;
use GuardsmanPanda\LarabearAuth\Infrastructure\Oauth2\Model\BearOauth2User;
use Illuminate\Support\Facades\Config;

class Oauth2UserService {
    public static function createOrUpdateFromCode(string $code, BearOauth2Client $client): BearOauth2User {
        $resp = Oauth2ClientService::exchangeCode(
            code: $code,
            redirect_uri: Config::get(key: 'app.url') . '/auth/callback/microsoft',
            client: $client
        );
        $token = OidcToken::fromJwt(jwt: $resp['id_token'], applicationId: $client->oauth2_client_id);
        $user = BearOauth2User::where(column: 'oauth2_client_id', operator: '=', value: $client->id)
            ->where(column: 'user_identifier', operator: '=', value: $token->userIdentifier)
            ->first();
        if ($user === null) {

        }
        return $user;
    }
}