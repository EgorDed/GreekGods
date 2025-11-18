<?php

//use App\Middlewares\CorsMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use App\Controllers\FileController;

return function (App $app) {
    $app->group('/api', function (RouteCollectorProxy $group) {
        $group->group('/v1', function (RouteCollectorProxy $group) {
            $group->get('/final/', [FileController::class, 'getFinalDot']);
        });
    });

};