<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class FileController extends BaseController
{
    private string $filePath = '/var/www/greek_gods/server/build/final.dot';

    /**
     * Метод для вывода final.dot
     */
    public function getFinalDot(Request $request, Response $response, $args): Response
    {
        exec('php /var/www/greek_gods/server/src/build.php', $out);

        if (!file_exists($this->filePath)) {
            return $this->createResponse($response, ['error' => 'final.dot not found'], 404);
        }

        $content = file_get_contents($this->filePath);

        return $this->createResponse($response, ['content' => $content]);
    }
}
