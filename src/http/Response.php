<?php
/**
 * @author stanislavtyrsa
 */

namespace books\http;

/**
 * Class Response
 * @package books\http
 */
class Response
{
    private $status = 200;

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @param $data
     */
    public function send($data)
    {
        http_response_code($this->status);
        header('Content-Type: application/json');
        echo $data;
    }
}