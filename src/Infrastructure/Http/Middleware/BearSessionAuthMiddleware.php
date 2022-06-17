<?php

namespace GuardsmanPanda\LarabearAuth\Infrastructure\Http\Middleware;

use Carbon\Carbon;
use Closure;
use GuardsmanPanda\Larabear\Infrastructure\App\Service\BearGlobalStateService;
use GuardsmanPanda\LarabearAuth\Infrastructure\Auth\Service\AuthService;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ViewErrorBag;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class BearSessionAuthMiddleware {
    private array $config;

    public function __construct(private readonly SessionManager $manager, private readonly ViewFactory $view) {
        $this->config = Config::get(key: 'session');
    }

    public function handle(Request $request, Closure $next, string $extra = null) {
        $session = $this->manager->driver();
        $session->setId($request->cookies->get(key: $this->config['cookie']));
        $this->startSession(request: $request, session: $session);
        $userId = $session->get(key: 'logged_in_user_id');

        //----------------------------------------------------------------------------------------------------------
        //  If we cannot find a userId in the session then only progress if explicitly allowed.
        //----------------------------------------------------------------------------------------------------------
        if ($userId === null && $extra !== 'allow-guest') {
            $target = Config::get(key: 'bear-auth.path_to_redirect_if_not_logged_in', default: '/');
            if ($request->acceptsHtml()) {
                return new RedirectResponse(url: $target, headers: ['HX-Redirect' => $target]);
            }
            return new Response(content: 'Not logged in.', status: 401, headers: ['HX-Redirect' => $target]);
        }

        //----------------------------------------------------------------------------------------------------------
        //  Set the user id on the various parts of the framework which expects it.
        //----------------------------------------------------------------------------------------------------------
        BearGlobalStateService::setUserId(userId: $userId);
        if ($userId !== null) {
            if (is_callable(value: Config::get(key: 'bear-auth.call_function_on_login'), callable_name: $callableName)) {
                $callableName($userId);
            }
            if (Config::get(key: 'bear-auth.set_user_on_auth_facade') === true) {
                Auth::onceUsingId(id: $userId);
            }
        } else { // Clear user id, this is only needed for laravel octane.
            if (is_callable(value: Config::get(key: 'bear-auth.call_function_on_logout'), callable_name: $callableName)) {
                $callableName();
            }
        }

        $response = $next($request);

        $response->headers->setCookie(new Cookie(
            name: $this->config['cookie'],
            value: $session->getId(),
            expire: $this->config['expire_on_close'] ? 0 : (new Carbon())->addMinutes($this->config['lifetime']),
            path: $this->config['path'],
            domain: $this->config['domain'],
            secure: $this->config['secure'],
            httpOnly: $this->config['http_only'],
            sameSite: $this->config['same_site']
        ));

        $session->save();
        return $response;
    }


    private function startSession(Request $request, Session $session): void {
        $session->setRequestOnHandler(request: $request);
        $session->start();
        $request->setLaravelSession(session: $session);
        if ($request->isMethod(method: 'GET') && !$request->ajax()) {
            $session->setPreviousUrl(url: $request->fullUrl());
        }
        $this->view->share(key: 'errors', value: $request->session()->get(key: 'errors') ?? new ViewErrorBag);
    }
}
