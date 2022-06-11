<?php

namespace GuardsmanPanda\LarabearAuth\Infrastructure\AccessToken\Crud;

use Carbon\CarbonInterface;
use GuardsmanPanda\LarabearAuth\Infrastructure\AccessToken\Model\BearApplicationAccessToken;

class BearApplicationAccessTokenCreator {
    public static function create(
        string          $access_token,
        string          $access_token_comment,
        string          $api_route_prefix = '',
        string          $api_primary_key = null,
        string          $server_hostname_restriction = null,
        string          $request_ip_restriction = '0.0.0.0/0',
        CarbonInterface $expires_at = null,
        int             $delete_get_request_log_after_days = null,
        int             $delete_all_request_log_after_days = null,
    ): BearApplicationAccessToken {
        $token = new BearApplicationAccessToken();
        $token->api_route_prefix = $api_route_prefix;
        $token->api_primary_key = $api_primary_key;
        $token->hashed_access_token = hash(algo: 'xxh128', data: $access_token);
        $token->access_token_comment = $access_token_comment;
        $token->server_hostname_restriction = $server_hostname_restriction;
        $token->request_ip_restriction = $request_ip_restriction;
        $token->expires_at = $expires_at;
        $token->delete_get_request_log_after_days = $delete_get_request_log_after_days;
        $token->delete_all_request_log_after_days = $delete_all_request_log_after_days;
        $token->save();
        return $token;
    }
}
