<?php
/**
 * @author stanislavtyrsa
 */

namespace books\parser;

use DOMDocument;
use DOMXPath;
use DOMNode;

/**
 * Class ParseUtils
 * @package books\parser
 */
class ParseUtils
{
    /**
     * @param string $path
     * @return DOMXPath
     */
    public static function getXPath(string $path): DOMXPath
    {
        $dom = new DOMDocument();
        $dom->loadHTML(file_get_contents($path));
        return new DOMXPath($dom);
    }

    /**
     * @param DOMXPath $root
     * @param string $className
     * @return DOMNode|null
     */
    public static function getDivByClassName(DOMXPath $root, string $className): ?DOMNode
    {
        return $root
            ->query("//div[contains(@class, '{$className}')]")
            ->item(0);
    }
}