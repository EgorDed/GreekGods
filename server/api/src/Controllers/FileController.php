<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class FileController
{
    // Метод для вывода final.dot
    public function getFinalDot(Request $request, Response $response, $args)
    {
        $file = __DIR__ . '/../../build/final.dot';

        if (!file_exists($file)) {
            $response->getBody()->write(json_encode(['error' => 'final.dot not found']));
            return $response->withStatus(404)
                ->withHeader('Content-Type', 'application/json');
        }

        $response->getBody()->write(json_encode([
            'content' => file_get_contents($file)
        ], JSON_UNESCAPED_UNICODE));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
