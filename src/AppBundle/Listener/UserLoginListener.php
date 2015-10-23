<?php


namespace AppBundle\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\SecurityEvents;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;


class UserLoginListener{

    public function onSecurityInteractiveLogin(){
//        echo 'yo yoyo';
//        exit;
    }
}