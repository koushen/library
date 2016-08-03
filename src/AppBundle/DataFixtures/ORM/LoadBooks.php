<?php
/**
 * Created by PhpStorm.
 * User: Alberto
 * Date: 03/08/2016
 * Time: 13:00
 */
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Book;

class LoadBookData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $book = new Book();
        $book->setTitulo('La historia interminable');
        $book->setAutor('Michael Ende');
        $book->setDescripcion('La historia interminable de treyu y demas');
        $book->setUbicacion('Alemania');
        $book->setEditorial('Thienemanns Verlag');
        $book->setCodigo(10);
        $fecha = '01/01/1979';
        $publicacion = new \DateTime($fecha)   ;
        $book->setPublicacion($publicacion);


        $manager->persist($book);
        $manager->flush();
    }
}
