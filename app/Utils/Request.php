<?php


namespace App\Utils;

/**
 * Class Request
 * @package App\Utils
 */
class Request
{
    /**
     * @var array
     */
    private $params = [];

    /**
     * @param $param
     * @return string|array|bool|null
     */
    public function get($param)
    {
        if (isset($this->params[$param])) {
            return $this->params[$param];
        }
        return null;
    }

    /**
     * @param array $params
     * @return bool
     */
    public function set(array $params)
    {
        if (count($params) === 0) {
            return false;
        }

        foreach ($params as $key => $param) {

            if (is_string($param)) {
               $this->params[$key] = htmlspecialchars($param);
            } else {
                $this->params[$key] = $param;
            }
        }

        return true;
    }
}
