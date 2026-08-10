<?php

use Slim\App;

use App\Controllers\AuthController;

return function (App $app) {
    $app->post('/auth/register', [AuthController::class, 'create_administrator']);
};