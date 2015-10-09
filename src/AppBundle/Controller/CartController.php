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
        $cart = $this->getCurrentCart();
        $form = $this->createForm('sylius_cart', $cart, ['action' => $this->generateUrl('sylius_cart_save')]);

        $view = $this
            ->view()
            ->setTemplate($this->config->getTemplate('summary.html'))
            ->setData(array(
                'cart' => $cart,
                'form' => $form->createView(),
                'test' => 'test'
            ))
        ;

        return $this->handleView($view);
    }

}
