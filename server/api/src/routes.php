<?php

use Slim\App;
use App\Controllers\FileController;

return function (App $app) {
    $app->get('/final', [FileController::class, 'getFinalDot']);
};
