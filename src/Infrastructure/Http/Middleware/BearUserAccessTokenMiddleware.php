<?php

namespace GuardsmanPanda\LarabearAuth\Infrastrcuture\Http\Middleware;

abstract class BearUserAccessTokenMiddleware {

    abstract protected function setLoggedInUser(string|int $userId): void;
}