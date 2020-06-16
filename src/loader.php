<?php
/**
 * @author stanislavtyrsa
 */

/**
 * Class Loader
 */
class Loader {

    private const BASE_NAMESPACE = "books";

    public static function register()
    {
        spl_autoload_register(new Loader());
    }

    public function __invoke(string $className)
    {
        $fName = str_replace('\\', '/',
                str_replace(self::BASE_NAMESPACE, "src", $className)) . '.php';
        /* @noinspection PhpIncludeInspection */
        include $fName;
    }
}

error_reporting(E_ERROR);
Loader::register();