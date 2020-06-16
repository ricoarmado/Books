<?php
/**
 * @author stanislavtyrsa
 */

namespace books\parser;

use books\data\Book;
use books\data\ParsedBook;
use DOMNodeList;

/**
 * Class DOMParser
 * @package books\parser
 */
class DOMParser
{
    const BASE_URL = 'https://book24.ru';
    const PROGRAMMING_BOOKS_URL = self::BASE_URL . '/catalog/programmirovanie-1361/';
    //books per page = 30
    const YEAR_LEX = 'Год издания:';
    const AUTHOR_LEX = 'Автор:';

    /**
     * @param int $page
     * @return ParseResult
     */
    public function parsePage(int $page = 1): ParseResult
    {
        $url = self::PROGRAMMING_BOOKS_URL;
        if ($page > 1) {
            $url .= "page-{$page}";
        }

        $xpath = ParseUtils::getXPath($url);
        $availablePages = ParseUtils::getDivByClassName($xpath, 'catalog-pagination__list')
                ->childNodes
                ->count() - 1;

        $books = ParseUtils::getDivByClassName($xpath, 'catalog-products__list js-catalog-products');
        return new ParseResult(self::parseBookList($books->childNodes), $page, $availablePages);
    }

    /**
     * @param DOMNodeList $books
     * @return array
     */
    private function parseBookList(DOMNodeList $books): array
    {
        $data = [];
        for ($i = 0; $i < $books->length; $i++) {
            $node = $books->item($i);
            $attrs = $node->firstChild->firstChild->firstChild->attributes;
            $bookPath = $attrs->item(1)->nodeValue;
            if ($bookPath !== null) {
                $data[] = self::parseBook($bookPath);
            }
        }
        return $data;
    }

    public function parseBook(string $path): Book
    {
        $xpath = ParseUtils::getXPath(self::BASE_URL.$path);
        $title = $xpath
            ->query("//h1[contains(@class, 'item-detail__title')]")
            ->item(0)
            ->nodeValue;

        $price = explode("\n",
            trim(ParseUtils::getDivByClassName($xpath, 'item-actions__price')->nodeValue))[0];


        $image = $xpath
            ->query("//img[contains(@class, 'item-cover__image _preload')]")
            ->item(0)
            ->attributes
            ->item(1)
            ->nodeValue;


        //scrap year and author
        $characterList = $xpath->query("//div[contains(@class, 'item-tab__chars-item')]");
        /** @var string $year */
        $year = null;
        /** @var string $authorNames */
        $authorNames = null;

        for ($i = 0; $i < $characterList->length; $i++) {
            $character = $characterList->item($i);
            if (strpos($character->nodeValue, self::AUTHOR_LEX) !== false) {
                $authorNames = preg_replace('/\s+/', ' ', trim($character->nodeValue));
            } else if (strpos($character->nodeValue, self::YEAR_LEX) !== false) {
                $year = preg_replace('/\W+/', '', $character->nodeValue);
            }
        }

        return ParsedBook::of([
            ParsedBook::TITLE_ATTR => $title,
            ParsedBook::PRICE_ATTR => $price,
            ParsedBook::IMAGE_PATH => $image,
            ParsedBook::YEAR_ATTR => $year,
            ParsedBook::AUTHOR_ATTR => $authorNames
        ]);
    }

}