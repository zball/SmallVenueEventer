<?php

namespace AppBundle\Listener;

use Symfony\Component\EventDispatcher\GenericEvent;

class CartListener {

    public function onProductAdd(GenericEvent $event){

//        echo '<pre>';
//        \Doctrine\Common\Util\Debug::dump($event);
//        exit;
    }

}