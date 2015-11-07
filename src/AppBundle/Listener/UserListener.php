<?php
/**
 * Created by PhpStorm.
 * User: zacball
 * Date: 11/3/15
 * Time: 2:52 AM
 */

namespace AppBundle\Listener;

use Application\Sonata\UserBundle\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;


class UserListener {

    private $container;

    public function __construct(ContainerInterface $container){
        $this->container = $container;;
    }

    public function prePersist(User $user, LifecycleEventArgs $args){

        $provider = $this->container->get('sylius.cart_provider');
        $cart = $provider->getCart();

        $expirationDate = new \DateTime();
        $expirationDate->add(new \DateInterval('P1M'));

        $cart->setExpiresAt($expirationDate);
        $user->setCart($cart);

    }

}