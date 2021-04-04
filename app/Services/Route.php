<?php


namespace App\Services;


class Route
{
    public static function make(string $path, string $method, string $controller, string $func)
    {
        global $ROUTS;
        $ROUTS[$method][] = [
            'path' => $path,
            'controller' => $controller,
            'func' => $func
        ];
    }
}
