<?php

namespace AppBundle\Controller;

use Sylius\Bundle\CartBundle\Controller\CartController as BaseController;

class CartController extends BaseController
{

    /**
     * Displays current cart summary page.
     * The parameters includes the form created from `sylius_cart` type.
     *
     * @return Response
     */
    public function summaryAction()
    {
        $cart = $this->isLoggedIn() ? $this->setUsersCart() : $this->getCurrentCart();


        $form = $this->createForm('sylius_cart', $cart, ['action' => $this->generateUrl('sylius_cart_save')]);

        $view = $this
            ->view()
            ->setTemplate($this->config->getTemplate('summary.html'))
            ->setData(array(
                'cart' => $cart,
                'form' => $form->createView()
            ))
        ;

        return $this->handleView($view);
    }

    public function setUsersCart(){
        $cart = $this->getUser()->getCart();
        $this->get('sylius.cart_provider')->setCart($cart);
        return $cart;
    }

    public function isLoggedIn(){
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
            return true;
    }

}
