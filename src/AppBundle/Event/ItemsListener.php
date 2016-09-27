<?php
/**
 * Created by PhpStorm.
 * User: Alberto
 * Date: 22/08/2016
 * Time: 12:39
 */
namespace AppBundle\Event;
use Symfony\Bridge\Monolog\Logger;
class ItemsListener
{
    private $logger;
    public function __construct($logger)
    {
        $this->logger = $logger;
    }
    public function onItemCreate(ItemEvent $event)
    {
        $book = $event->getBook();
        $this->logger->info('Se ha creado el libro: '.$book->getTitulo().', con codigo'. $book->getCodigo());
    }

}