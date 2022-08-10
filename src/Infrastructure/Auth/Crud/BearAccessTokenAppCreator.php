<?php

namespace GuardsmanPanda\LarabearAuth\Infrastructure\Auth\Crud;

use Carbon\CarbonInterface;
use GuardsmanPanda\LarabearAuth\Infrastructure\Auth\Model\BearAccessTokenApp;
use Illuminate\Support\Str;

class BearAccessTokenAppCreator {
    public static function create(
        string          $access_token,
        string          $access_token_purpose,
        string          $route_prefix_restriction = '',
        string          $api_primary_key = null,
        string          $server_hostname_restriction = null,
        string          $request_ip_restriction = '0.0.0.0/0',
        CarbonInterface $expires_at = null,
        int             $delete_get_request_log_after_days = 40,
        int             $delete_all_request_log_after_days = 400,
    ): BearAccessTokenApp {
        $token = new BearAccessTokenApp();
        $token->id = Str::uuid()->toString();
        $token->route_prefix_restriction = $route_prefix_restriction;
        $token->api_primary_key = $api_primary_key;
        $token->hashed_access_token = hash(algo: 'xxh128', data: $access_token);
        $token->access_token_purpose = $access_token_purpose;
        $token->server_hostname_restriction = $server_hostname_restriction;
        $token->request_ip_restriction = $request_ip_restriction;
        $token->expires_at = $expires_at;
        $token->delete_get_request_log_after_days = $delete_get_request_log_after_days;
        $token->delete_all_request_log_after_days = $delete_all_request_log_after_days;
        $token->save();
        return $token;
    }
}
