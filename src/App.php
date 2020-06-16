<?php
/**
 * @author stanislavtyrsa
 */

namespace books;

use books\controller\DefaultController;
use books\http\Request;
use books\http\Response;

/**
 * Class App
 * @package books
 */
class App
{

    /**
     * @var App
     */
    private static $instance;

    /**
     * App constructor.
     */
    private function __construct()
    {

    }

    /**
     * @return App
     */
    public static function getInstance(): App
    {
        if (self::$instance === null) {
            self::$instance = new App();
        }
        return self::$instance;
    }

    public function run()
    {
        $path = $_SERVER['REQUEST_URI'];
        static $map;
        $map ?: $map = [
            '/' => 'sendStaticPage',
            '/book' => 'loadBook'
        ];
        $method = $map[explode("?", $path)[0]] ?? null;
        if ($method !== null) {
            $ctr = new DefaultController();
            $ctr->{$method}(new Request(), new Response());
        }
    }
}