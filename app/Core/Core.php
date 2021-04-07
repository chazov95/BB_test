<?php


namespace App\Core;


use App\Controllers\AbstractController;
use App\Models\Api\Responses\GetCardsResponse;
use App\Services\Route;
use App\Utils\Request;
use http\Env\Response;

/**
 * Class Core
 * @package App\Core
 */
class Core
{
    public static function load()
    {
        global $ROUTS;

        $routeBlocks = $ROUTS[$_SERVER['REQUEST_METHOD']];
        $urlAr = explode('?', $_SERVER['REQUEST_URI']);

        foreach ($routeBlocks as $routeBlock) {

            if ($routeBlock['path'] === $urlAr[0]) {

                $controllerName = '\App\Controllers\\' . $routeBlock['controller'];
                $controller = new $controllerName();
                $request = new Request();
                $request->set($_REQUEST);
                $funcName = $routeBlock['func'];
                print_r($controller->$funcName($request));

            }
        }
    }
}
