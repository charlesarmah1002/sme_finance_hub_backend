<?php

use Slim\App;

return function (App $app) {
    (require __DIR__ . "/Routes/AuthRoute.php")($app);
};