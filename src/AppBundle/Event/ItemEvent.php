<?php
/**
 * Created by PhpStorm.
 * User: Alberto
 * Date: 26/09/2016
 * Time: 18:43
 */

namespace AppBundle\Event;
use AppBundle\Entity\Book;
use Symfony\Component\EventDispatcher\Event;

class ItemEvent extends Event
{
    private $book;
    public function __construct(Book $book)
    {
        $this->book = $book;
    }
    public function getBook()
    {
        return $this->book;
    }
}