<?php
/**
 * @author stanislavtyrsa
 */

namespace books\data;

/**
 * Interface Book
 * @package books\data
 */
interface Book
{
    /**
     * @return string|null
     */
    public function getAuthor(): ?string;

    /**
     * @return string|null
     */
    public function getTitle(): ?string;

    /**
     * @return string|null
     */
    public function getPrice(): ?string;

    /**
     * @return int|null
     */
    public function getYear(): ?string;

    /**
     * @return string|null
     */
    public function getImg(): ?string;

    /**
     * @return int|null
     */
    public function getDeliveryPrice(): ?int;
}