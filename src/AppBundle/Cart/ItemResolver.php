<?php
/**
 * Created by PhpStorm.
 * User: zacball
 * Date: 9/22/15
 * Time: 3:48 AM
 */

namespace AppBundle\Cart;

use AppBundle\Entity\CartItem;
use AppBundle\Entity\Ticket;
use Sylius\Bundle\CartBundle\Controller\CartItemController;
use Sylius\Component\Cart\Model\CartItemInterface;
use Sylius\Component\Cart\Resolver\ItemResolverInterface;
use Doctrine\ORM\EntityManager;
use Sylius\Component\Cart\Resolver\ItemResolvingException;


use Symfony\Component\Form\FormFactory;

class ItemResolver implements ItemResolverInterface
{
    private $entityManager;
    private $formFactory;
    private $cartItemController;

    public function __construct(EntityManager $entityManager, FormFactory $formFactory, CartItemController $cic)
    {
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
        $this->cartItemController = $cic;
    }

    public function resolveTicket(CartItemInterface $item, Ticket $ticket){

        $productId = $ticket->getId();

        // If no product id given, or product not found, we throw exception with nice message.
        if (!$productId || !$product = $this->getProductRepository()->find($productId)) {
            throw new ItemResolvingException('Requested product was not found');
        }

        // Everything went fine, return the item.
        return $item;

    }

    public function resolve(CartItemInterface $item, $request)
    {
        $productId = $request->query->get('ticketId');

        // If no product id given, or product not found, we throw exception with nice message.
        if (!$productId || !$product = $this->getProductRepository()->find($productId)) {
            throw new ItemResolvingException('Requested product was not found');
        }

        if( $product instanceof Ticket ){
            $emptyItem = $this->cartItemController->createNew();
            $productForForm = $this->resolveTicket($emptyItem, $product);
        }

        $form = $this->formFactory->create('sylius_cart_item', $productForForm);
        $form->handleRequest($request);

        $item = $form->getData();

        // Assign the product to the item and define the unit price.
        $item->setTicket($product);
        $item->setUnitPrice((floatval($product->getPrice())));

        if ($form->isValid()) {
            return $item;
        }
        throw new ItemResolvingException('Submitted form is invalid');
    }

    private function getProductRepository()
    {
        return $this->entityManager->getRepository('AppBundle:Ticket');
    }
}