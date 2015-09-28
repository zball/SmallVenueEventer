<?php

namespace AppBundle\Listener;

use AppBundle\Entity\Event;
use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Ticket;


class EventListener {

    public function prePersist(Event $event, LifecycleEventArgs $args){

        $em = $args->getEntityManager();

        $ticket = new Ticket();
        $ticket->setBarcode(3497539475);
        $ticket->setPrice(12.50);
        $ticket->setEvent($event);

        $em->persist($ticket);

    }

}