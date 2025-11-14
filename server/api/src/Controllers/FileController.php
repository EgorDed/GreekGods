<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class FileController extends BaseController
{
    /**
     * Метод для вывода final.dot
     */
    public function getFinalDot(): Response
    {
        $file = __DIR__ . '/../../build/final.dot';

        if (!file_exists($file)) {
            return $this->jsonResponse(['error' => 'final.dot not found'], 404);
        }

        $content = file_get_contents($file);

        return $this->jsonResponse(['content' => $content]);
    }
}
