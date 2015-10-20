<?php
/**
 * Created by PhpStorm.
 * User: zacball
 * Date: 10/14/15
 * Time: 1:42 AM
 */

namespace AppBundle\Controller;


use AppBundle\Entity\BillingAddress;
use AppBundle\Form\Type\BillingAddressType;
use Application\Sonata\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class CheckoutController extends  Controller{

    /**
     * @Route("/checkout", name="cart_checkout", schemes={"https"})
     */
    public function indexAction(Request $request){

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('fos_user_registration_register');
        }

        $user = $this->getUser();
        $billingAddress = ($user->getBillingAddress()) ? $user->getBillingAddress() : new BillingAddress();

        $form = $this->createForm(new BillingAddressType(), $billingAddress);
        $form->handleRequest($request);

        if($form->isValid()){

            $em = $this->getDoctrine()->getManager();

            $billingAddress->setUser($user);
            $em->persist($billingAddress);
            $em->flush();

            return $this->redirectToRoute('cart_checkout_payment');
        }


        return $this->render('default/checkout.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/checkout/payment", name="cart_checkout_payment", schemes={"https"})
     */
    public function paymentAction(Request $request){
        return $this->render('default/checkout_payment.html.twig', [
            //'form' => $form->createView()
        ]);
    }

}

