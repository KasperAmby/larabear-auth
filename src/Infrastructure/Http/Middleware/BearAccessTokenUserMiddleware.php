<?php

namespace GuardsmanPanda\LarabearAuth\Infrastructure\Http\Middleware;

use Closure;
use GuardsmanPanda\Larabear\Infrastructure\App\Service\BearGlobalStateService;
use GuardsmanPanda\Larabear\Infrastructure\Http\Service\Req;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class BearAccessTokenUserMiddleware {
    public function handle(Request $request, Closure $next) {
        if ($request->bearerToken() === null) {
            throw new AccessDeniedHttpException(message: 'The request must include a bearer token.');
        }
        $hashed_access_token = hash(algo: 'xxh128', data: $request->bearerToken());
        $access = DB::selectOne("
            SELECT at.id, at.user_id, at.expires_at, at.invalid_at
            FROM bear_access_token_user at
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
            INSERT INTO bear_log_access_token_usage (request_ip, request_country_code, request_http_method, request_http_path, response_status_code, response_time_in_milliseconds, access_token_user_id)
            VALUES (?, ?, ?, ?, ?, ?, ?)",
            [Req::ip(), Req::ipCountry(), Req::method(), Req::path(), $status_code, $time, BearGlobalStateService::getUserId()]
        );
    }
}
