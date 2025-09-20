<?php
namespace Revyan\Savios\Routes;

use Psr\Http\Message\ResponseInterface as Res;
use Psr\Http\Message\ServerRequestInterface as Req;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

class Routes
{
    public static function init(App $app): void
    {
        $app->group('/api/v1', function (RouteCollectorProxy $api) {
            self::InitUserRoutes($api);

            $api->get('/', function (Req $request, Res $response, $args): Res {
                $response->getBody()->write("Halo dari root");
                return $response;
            });
        });
    }

    private static function InitUserRoutes(RouteCollectorProxy $api): void
    {
        $api->group('/user', function (RouteCollectorProxy $user) {
            $user->get('/lists', function (Req $request, Res $response, $args): Res {
                $response->getBody()->write("Halo dari user");
                return $response;
            });
        });
    }
}
