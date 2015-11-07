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
use AppBundle\Form\Type\CreditCardType;
use AppBundle\Service\StripeProcessor;
use Application\Sonata\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class CheckoutController extends  Controller{

    private $customer;

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

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('fos_user_registration_register');
        }
        $paymentProcessor = $this->get('stripe_processor');
        $user = $this->getUser();

        $form = $this->createForm(new CreditCardType());
        $form->handleRequest($request);

        if($form->isValid()){

                // Get the credit card details submitted by the form
                $token = $form->get('stripeToken')->getData();

                $paymentProcessor->setToken($token);
                $paymentProcessor->createCustomer($user->getEmail());
                $customer = $paymentProcessor->getCustomer();

                $em = $this->getDoctrine()->getManager();

                $user->setCustomerId($customer->id);

                $em->persist($user);
                $em->flush();

            return $this->redirectToRoute('cart_checkout_confirmation');

        }

        if($user->getCustomerId() != '0'){
            $paymentProcessor->setCustomerById($user->getCustomerId());
            $this->customer = $paymentProcessor->getCustomer();
        }

        return $this->render('default/checkout_payment.html.twig', [
            'form' => $form->createView(),
            'customer' => $this->customer
        ]);
    }

    /**
     * @Route("/checkout/confirmation", name="cart_checkout_confirmation", schemes={"https"})
     */
    public function confirmationAction(Request $request){

        $user = $this->getUser();
        $paymentProcessor = $this->get('stripe_processor');
        $paymentProcessor->setCustomerById($user->getCustomerId());

        $customer = $paymentProcessor->getCustomer();

        return $this->render('default/checkout_confirmation.html.twig', [ 'customer' => $customer ]);

    }

    /**
     * @Route("/checkout/receipt", name="cart_checkout_receipt", schemes={"https"})
     */
    public function processOrderAction(Request $request){

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('fos_user_registration_register');
        }

        $user = $this->getUser();

        $cartProvider = $this->get('sylius.cart_provider');
        $cart = $cartProvider->getCart();

        $paymentProcessor = $this->get('stripe_processor');
        $paymentOptions = [
            'amount' => ($cart->getTotal() * 100),
            'currency' => 'usd',
            'customer' => $user->getCustomerId()
        ];
        $paymentProcessor->charge($paymentOptions);

        return $this->render('default/checkout_processed_confirmation.html.twig');

    }

}

