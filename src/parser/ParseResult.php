<?php
/**
 * @author stanislavtyrsa
 */

namespace books\parser;

use books\data\Book;

/**
 * Class ParseResult
 * @package books\parser
 */
class ParseResult
{
    /** @var array $listOfBooks */
    private $listOfBooks = [];

    /** @var int int */
    private $currentPage = 0;

    /** @var bool $last */
    private $last = false;

    /**
     * ParseResult constructor.
     * @param array $list
     * @param int $currentPage
     * @param int $totalPages
     */
    public function __construct(array $list, int $currentPage,  int $totalPages)
    {
        $this->currentPage = $currentPage;
        $this->listOfBooks = $list;
        $this->last = $currentPage === $totalPages;
    }

    /**
     * @return array
     */
    public function getListOfBooks(): array
    {
        return $this->listOfBooks;
    }

    /**
     * @return array
     */
    public function __serialize(): array
    {
        return [
          'list' => array_map(function ($e) {/** @var $e Book */ return $e->__serialize();}, $this->listOfBooks),
          'hasNext' => $this->hasNext(),
          'currentPage' => $this->currentPage
        ];
    }


    public function __toString()
    {
        return json_encode($this->__serialize());
    }


    /**
     * @return bool
     */
    public function hasNext(): bool {
        return !$this->last;
    }
}