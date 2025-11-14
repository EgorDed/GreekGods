<?php
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BaseController
{
    /** @var Request */
    protected $request;

    /** @var Response */
    protected $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Получение GET-параметра по имени
     */
    protected function getQueryParam(string $name, $default = null)
    {
        $queryParams = $this->request->getQueryParams();
        return $queryParams[$name] ?? $default;
    }

    /**
     * Получение POST-параметра по имени
     */
    protected function getPostParam(string $name, $default = null)
    {
        $parsedBody = $this->request->getParsedBody();
        return $parsedBody[$name] ?? $default;
    }

    /**
     * Отправка JSON-ответа
     */
    protected function jsonResponse(array|object $data, int $status = 200): Response
    {
        $payload = json_encode($data, JSON_UNESCAPED_UNICODE);

        $this->response->getBody()->write($payload);

        return $this->response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($status);
    }
}
