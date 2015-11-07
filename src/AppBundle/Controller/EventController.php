<?php
/**
 * Created by PhpStorm.
 * User: zacball
 * Date: 10/6/15
 * Time: 2:15 AM
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\CartItem;
use Symfony\Component\HttpFoundation\Request;
use Stripe\Stripe;

/**
 * Class EventController
 * @package AppBundle\Controller
 */
class EventController extends Controller{

    /**
     * @param $id
     * @Route("/event/{id}")
     * @return Response
     */
    public function indexAction($id){

        $event = $this->getDoctrine()->getRepository('AppBundle:Event')->find($id);
        $ticket = $event->getTicket();

        $emptyProduct = $this->get('sylius.controller.cart_item')->createNew();

        $cartItems = $this->get('sylius.cart_provider')->getCart()->getItems();
        foreach($cartItems as $item){
            $tempTicket = $item->getTicket();
            if ( $id == $tempTicket->getEvent()->getId() ){
                $ticket = $tempTicket;
                $emptyProduct->setQuantity($item->getQuantity());
            }
        }

        $product = $this->get('sylius.cart_resolver')->resolveTicket($emptyProduct, $ticket);

        $form = $this->createForm('sylius_cart_item', $product, [
                'action' => $this->generateUrl('sylius_cart_item_add', ['ticketId' => $ticket->getId()] )] );

        return $this->render('default/event.html.twig', array(
            'ticket' => $ticket,
            'form' => $form->createView()
        ));

    }

}