<?php

use Slim\App;

use App\Controllers\AuthController;

return function (App $app) {
    $app->post('/auth/register', [AuthController::class, 'create_account']);
    $app->post('/auth/login', [AuthController::class, 'verify_user_account']);
    $app->get('/auth/verify_email/{encoded_url}', [AuthController::class, 'verify_email']); 
    $app->post('/auth/update_password', [AuthController::class, 'update_password']);
    $app->post('/auth/forgot_password', [AuthController::class, 'forgot_password']);
};