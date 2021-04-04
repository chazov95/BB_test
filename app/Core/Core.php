<?php


namespace App\Core;


use App\Controllers\AbstractController;
use App\Models\Api\Responses\GetCardsResponse;
use App\Services\Route;
use App\Utils\Request;
use http\Env\Response;

class Core
{

    public static function load()
    {
        if ((stripos($_SERVER['REDIRECT_URL'], '/res/img/')) === 0) {
            $imgExtension = substr($_SERVER['REDIRECT_URL'], -4);
            $imgName = trim(strrchr($_SERVER['REDIRECT_URL'], '/'), '/');

            if (is_file($_SERVER['DOCUMENT_ROOT'] . '/../' . $_SERVER['REDIRECT_URL'])) {
                header("Content-Disposition: attachment; filename=$imgName");

                switch ($imgExtension) {
                    case $imgExtension == '.jpg':
                        header("Content-type: image/jpg");
                        header('Content-Length: ' .
                            filesize($_SERVER['DOCUMENT_ROOT'] . '/../' . $_SERVER['REDIRECT_URL']));
                        print file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../' . $_SERVER['REDIRECT_URL']);
                        return;

                    case $imgExtension == '.png':
                        header("Content-type: image/png");
                        header("Content-Disposition: attachment; filename=$imgName");
                        header('Content-Length: ' .
                            filesize($_SERVER['DOCUMENT_ROOT'] . '/../' . $_SERVER['REDIRECT_URL']));
                        print file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../' . $_SERVER['REDIRECT_URL']);
                        return;
                }
            }
            else {
                return AbstractController::jsonResponse(false,404);
            }
        }

        if ((stripos($_SERVER['REDIRECT_URL'], '/res/pdf/')) === 0) {

        }
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