<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class BaseController
{
    protected static function createResponse(Response $response, array $data, int $status = 200): Response
    {
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus($status);
    }

    protected static function getGetParamByCode(Request $request, string $paramCode): mixed
    {
        return $request->getQueryParams()[$paramCode] ?? null;
    }

    protected static function getPostParamByCode(Request $request, string $paramCode): mixed
    {
        return $request->getParsedBody()[$paramCode] ?? null;
    }
}
