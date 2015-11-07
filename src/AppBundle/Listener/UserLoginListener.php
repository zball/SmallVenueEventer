<?php


namespace AppBundle\Listener;

use Doctrine\ORM\EntityManager;
use Sylius\Component\Cart\Provider\CartProviderInterface;
use Symfony\Component\EventDispatcher\Debug\TraceableEventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Http\SecurityEvents;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Sylius\Component\Cart\Event\CartEvent;
use Sylius\Component\Cart\SyliusCartEvents;
use Sylius\Component\Cart\Event\CartItemEvent;


class UserLoginListener{

    private $entityManager;
    private $tokenStorage;
    private $cartProvider;
    private $eventDispatcher;

    function __construct(EntityManager $em, TokenStorage $ts, CartProviderInterface $cpi, TraceableEventDispatcher $ed){
        $this->entityManager = $em;
        $this->tokenStorage = $ts;
        $this->cartProvider = $cpi;
        $this->eventDispatcher = $ed;
    }

    public function onSecurityInteractiveLogin(){

        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1M'));

        $user = $this->tokenStorage->getToken()->getUser();

        $userCart = $user->getCart();
        $cartInSession = $this->cartProvider->getCart();

        if(!$userCart){

            $cartInSession->setExpiresAt($expirationDate);
            $user->setCart($cartInSession);
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }

        if($userCart){

            foreach($cartInSession->getItems() as $item){

                foreach($userCart->getItems() as $ui){
                    $inCart[] = $ui->getTicket()->getId();
                }

                if(false !== ($key = array_search($item->getTicket()->getId(), $inCart))){
                    $userCart->getItems()[$key]->setQuantity( $userCart->getItems()[$key]->getQuantity() + $item->getQuantity());
                    $cartInSession->removeItem($item);
                }else{
                    $userCart->addItem($item);
                }
            }
            $userCart->setExpiresAt($expirationDate);

            $this->entityManager->remove($cartInSession);

            $event = new CartEvent($userCart);
            $event->isFresh(true);

            $this->eventDispatcher->dispatch(SyliusCartEvents::CART_CHANGE, new GenericEvent($userCart) );

            // Update models
            $this->eventDispatcher->dispatch(SyliusCartEvents::CART_SAVE_INITIALIZE, $event);
        }



    }
}