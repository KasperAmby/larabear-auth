<?php

return [
    'set_user_on_auth_facade' => false,
    'call_function_on_login' => [], // PHP callable reference  which receives the user id on login, example: [\Infrastructure\Auth\Service\Auth::class, 'setUserId']
    'path_to_redirect_if_not_logged_in' => '/',
];
