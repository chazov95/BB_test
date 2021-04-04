<?php


namespace App\Controllers;

use App\Utils\Request;
use App\Utils\Validator;

/**
 * Class MainController
 * @package App\Controllers
 */
class MainController
{
    public function show()
    {
        require $_SERVER['DOCUMENT_ROOT'] . '/../' . '/view/client.php';
    }
}
