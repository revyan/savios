<?php
use Revyan\Savios\Routes\Routes;
use Psr\Http\Message\ResponseInterface as Res;
use Psr\Http\Message\ServerRequestInterface as Req;
use Revyan\Savios\Utils\Response;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$errorMiddleware->setErrorHandler(
    Slim\Exception\HttpNotFoundException::class,
    function (Req $request, Slim\Exception\HttpNotFoundException $exception, bool $displayErrorDetails) use ($app): Res {
        $response = $app->getResponseFactory()->createResponse();
        return Response::error($response, null, "path not found", 404);
    }
);

Routes::init($app);

$app->run();
