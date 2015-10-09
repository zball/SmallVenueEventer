<?php

namespace AppBundle\Controller;

use AppBundle\Cart\ItemResolver;
use AppBundle\Entity\CartItem;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Ticket;
use Doctrine\ORM\EntityManager;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $ticket = $this->getDoctrine()
            ->getRepository('AppBundle:Ticket')
            ->find(1);
        $emptyItem = new CartItem();
        $resolver = $this->container->get('sylius.cart_resolver');
        $item = $resolver->resolveTicket($emptyItem, $ticket);

        $form = $this->createForm('sylius_cart_item', $item);


        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'ticket' => $ticket,
            'form' => $form->createView()
        ));
    }


}
