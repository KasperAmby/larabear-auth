<?php

namespace GuardsmanPanda\LarabearAuth\Infrastructure\Http\Middleware;

use Closure;
use GuardsmanPanda\Larabear\Enum\BearSeverityEnum;
use GuardsmanPanda\Larabear\Infrastructure\Security\Crud\BearSecurityIncidentCreator;
use GuardsmanPanda\LarabearAuth\Infrastructure\Auth\Service\AuthService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class BearPermissionMiddleware {
    public function handle(Request $request, Closure $next, string $permission): Response {
        $result = AuthService::hasPermission(permission: $permission);
        if ($result !== true) {
            BearSecurityIncidentCreator::create(
                severity: BearSeverityEnum::MEDIUM,
                namespace: 'permission-middleware',
                headline: 'Permission Check Failed',
                description: 'User tried to access a resource that requires a permission that the user does not have.',
                remediation: "You either need to add the permission to the user or remove the permission from the resource. (But only if  the user is supposed to access this resource.)",
                causedByUserId: AuthService::id()
            );
            throw new AccessDeniedHttpException(message: 'You do not have the required permission.');
        }
        return $next($request);
    }
}