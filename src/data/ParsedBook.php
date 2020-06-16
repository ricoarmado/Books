<?php
/**
 * @author stanislavtyrsa
 */

namespace books\data;

/**
 * Class ParsedBook
 * @package books\data
 */
class ParsedBook implements Book
{
    const AUTHOR_ATTR = 'author';
    const TITLE_ATTR = 'title';
    const PRICE_ATTR = 'price';
    const YEAR_ATTR = 'year';
    const IMAGE_PATH = 'img';
    const DELIVERY_PRICE_ATTR = 'delPrice';


    /** @var array $data */
    private $data = [];

    /**
     * ParsedBook constructor.
     * @param array $data
     */
    public function __construct(array &$data)
    {
        $this->data = $data;
    }


    /**
     * @inheritDoc
     */
    public function getAuthor(): ?string
    {
        return $this->data[self::AUTHOR_ATTR] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getTitle(): ?string
    {
        return $this->data[self::TITLE_ATTR] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getPrice(): ?string
    {
        return $this->data[self::PRICE_ATTR] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getYear(): ?string
    {
        return $this->data[self::YEAR_ATTR] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getImg(): ?string
    {
        return $this->data[self::IMAGE_PATH] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getDeliveryPrice(): ?int
    {
        return $this->data[self::DELIVERY_PRICE_ATTR] ?? null;
    }

    /**
     * @return array
     */
    public function __serialize(): array
    {
        return [
            self::AUTHOR_ATTR => $this->getAuthor(),
            self::YEAR_ATTR => $this->getYear(),
            self::IMAGE_PATH => $this->getImg(),
            self::PRICE_ATTR => $this->getPrice(),
            self::TITLE_ATTR => $this->getTitle()
        ];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return json_encode($this->__serialize());
    }

    /**
     * @param array $data
     * @return $this
     */
    public static function of(array $data): Book
    {
        return new self($data);
    }
}