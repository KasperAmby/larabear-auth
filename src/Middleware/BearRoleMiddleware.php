<?php

namespace GuardsmanPanda\LarabearAuth\Middleware;

use Closure;
use GuardsmanPanda\Larabear\Enum\BearSeverityEnum;
use GuardsmanPanda\Larabear\Infrastructure\Security\Crud\BearSecurityIncidentCreator;
use GuardsmanPanda\LarabearAuth\Service\AuthService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class BearRoleMiddleware {
    public function handle(Request $request, Closure $next, string $role): Response {
        $result = AuthService::hasRole(role: $role);
        if ($result !== true) {
            BearSecurityIncidentCreator::create(
                namespace: 'role-middleware',
                severity: BearSeverityEnum::MEDIUM,
                headline: 'Role Check Failed',
                description: 'User tried to access a resource that requires a role that the user does not have.',
                remediation: "You either need to add the role to the user or remove the role from the resource. (But only if  the user is supposed to access this resource.)",
                causedByUserId: AuthService::id()
            );
            throw new AccessDeniedHttpException(message: 'You do not have the required role.');
        }
        return $next($request);
    }
}