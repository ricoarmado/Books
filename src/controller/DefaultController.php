<?php
/**
 * @author stanislavtyrsa
 */

namespace books\controller;

use books\http\Request;
use books\http\Response;
use books\parser\DOMParser;

/**
 * Class DefaultController
 * @package books\controller
 */
class DefaultController
{
    /**
     * @param Request $request
     * @param Response $response
     */
    public function loadBook(Request $request, Response $response)
    {
        $page = $request->get('page') ?? 1;
        $result = (new DOMParser)->parsePage($page);
        $response->send($result);
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public function sendStaticPage(Request $request, Response $response)
    {
        $path = ROOT_PATH . '/web/mainpage.php';
        /* @noinspection PhpIncludeInspection */
        include $path;
    }
}