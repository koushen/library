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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Book;
use AppBundle\Model\Emails;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;

use AppBundle\Event\ItemEvent;
use AppBundle\Event\ItemsListener;

class BookController extends Controller
{
    /**
     *
     * * @Route("/book/{book_id}",
     *       defaults = { "book_id" = "1001" }
     * )
     */
    public function indexAction($book_id)
    {
        $logger = $this->get('logger');
        $logger->info('usuario pide la información de un libro');

        return new Response(
            '<html><body>Estas buscando informacion sobre el libro: '.$book_id.'</body></html>'
        );
    }
    /**
     *
     * * @Route("/newbook"
     *
     * )
     */
    public function createAction(Request $request)
    {
        $book = new Book();
        $form = $this->createFormBuilder($book)
            ->add('codigo')
            ->add('titulo')
            ->add('autor')
            ->add('editorial')
            ->add('descripcion')
            ->add('publicacion', 'date')
            ->add('ubicacion')
            ->add('save', 'submit')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $logger = $this->get('logger');
            $logger->info('se ha creado un libro nuevo'. $book->getCodigo());
            $em->flush();
            $mailer = $this->get('emailalta');
            $mailer->createEmailAlta();
            $mailer->sendEmail();

            $logger = $this->get('logger');
            $logger->info('mandando un email de aviso por la creación de nuevo libro:   '.$mailer->sendEmail());

            /*lanzamos el evento para el log*/

            $this->get('event_dispatcher')->dispatch('item.create', new ItemEvent($book));

            $logger = $this->get('logger');
            $logger->info('El libro se ha añadido correctamente');
            return new Response('El libro se ha añadido correctamente');
        }
        return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

