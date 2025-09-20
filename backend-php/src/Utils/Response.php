<?php
namespace Revyan\Savios\Utils;

use Psr\Http\Message\ResponseInterface as Res;

class Response
{
    public static function success(Res $response, $data = null, string $message = 'OK', int $status = 200): Res
    {
        $payload = [
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ];

        $response->getBody()->write(json_encode($payload, JSON_UNESCAPED_UNICODE));
        return $response->withHeader('Content-Type', 'application/json')->withStatus($status);
    }

    public static function error(Res $response, $data = null, string $message = 'ERROR', int $status = 500): Res
    {
        $payload = [
            'status' => 'error',
            'message' => $message,
            'data' => $data
        ];

        $response->getBody()->write(json_encode($payload, JSON_UNESCAPED_UNICODE));
        return $response->withHeader('Content-Type', 'application/json')->withStatus($status);
    }
}