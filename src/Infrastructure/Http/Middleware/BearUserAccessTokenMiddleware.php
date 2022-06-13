<?php

namespace GuardsmanPanda\LarabearAuth\Infrastructure\Http\Middleware;

use Closure;
use GuardsmanPanda\Larabear\Infrastructure\Http\Service\Req;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class BearUserAccessTokenMiddleware {
    private static string|null $access_token_id = null;

    public function handle(Request $request, Closure $next) {
        if ($request->bearerToken() === null) {
            throw new AccessDeniedHttpException(message: 'The request must include a bearer token.');
        }
        $hashed_access_token = hash(algo: 'xxh128', data: $request->bearerToken());
        $access = DB::selectOne("
            SELECT at.id, at.user_id, at.expires_at, at.invalid_at
            FROM bear_user_access_token at
            WHERE at.hashed_access_token = ? 
        ", [$hashed_access_token]);

        return $next($request);
    }


    public function terminate(Request $request, Response $response): void {
        $status_code = $response->getStatusCode();
        $time = -1;
        if (defined(constant_name: 'LARAVEL_START')) {
            $time = (int)((microtime(as_float: true) - get_defined_constants()['LARAVEL_START']) * 1000);
        }
        DB::insert("
            INSERT INTO bear_access_token_log (request_ip, request_country_code, request_http_method, request_http_path, request_http_query, request_http_hostname, response_status_code, response_body, response_time_in_milliseconds, user_access_token_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [Req::ip(), Req::ipCountry(), Req::method(), Req::path(), $query_json, Req::hostname(), $status_code, $status_code >= 400 ? $response->getContent() : null, $time, self::$access_token_id]
        );
    }
}
