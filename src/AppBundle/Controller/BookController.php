<?php
/**
 * Created by PhpStorm.
 * User: Alberto
 * Date: 01/08/2016
 * Time: 14:19
 */

namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BookController
{
    /**
     *
     * * @Route(
     *       path     = "/book/{book_id}",
     *       defaults = { "book_id" = "1001" }
     * )
     */
    public function indexAction($book_id)
    {
        return new Response(
            '<html><body>Estas buscando informacion sobre el libro: '.$book_id.'</body></html>'
        );
    }
}