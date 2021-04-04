<?php


namespace App\Repositories;

use Settings;


/**
 * Class AbstractRepository
 * @package App\Repositories
 */
abstract class AbstractRepository
{
    private string $host;
    private string $user;
    private string $password;
    private string $database;

    public function __construct()
    {
        require_once('./.settings.php');
        $this->host = Settings::host;
        $this->user = Settings::user;
        $this->password = Settings::password;
        $this->database = Settings::database;
    }

    public function connect()
    {
        return mysqli_connect($this->host, $this->user, $this->password, $this->database);
    }

}
