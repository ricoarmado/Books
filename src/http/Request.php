<?php
/**
 * @author stanislavtyrsa
 */

namespace books\http;

/**
 * Class Request
 * @package books\http
 */
class Request
{
    /** @var array $params */
    private $params = [];

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->params = $_GET;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key) {
        return $this->params[$key] ?? null;
    }
}