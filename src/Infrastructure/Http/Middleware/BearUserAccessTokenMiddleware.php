<?php

namespace GuardsmanPanda\LarabearAuth\Infrastructure\Http\Middleware;

abstract class BearUserAccessTokenMiddleware {

    abstract protected function setLoggedInUser(string|int $userId): void;
}