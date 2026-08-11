<?php

use Slim\App;

use App\Controllers\AuthController;

return function (App $app) {
    $app->post('/auth/register', [AuthController::class, 'create_account']);
    $app->post('/auth/login', [AuthController::class, 'verify_user_account']);
    $app->get('/auth/verify_email', [AuthController::class, 'verify_email']);
};