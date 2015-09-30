<?php

namespace AppBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use AppBundle\Entity\Ticket;


class EventListener {

    private $event;
    private $ticket;

    public function __construct(Ticket $ticket){
        $this->ticket = $ticket;
    }

    public function prePersist(LifecycleEventArgs $args){

        $this->event = $args->getEntity();

    }

    public function preFlush(PreFlushEventArgs $args){

        $em = $args->getEntityManager();

        $this->ticket->setBarcode(785885);
        $this->ticket->setPrice(15.50);
        $this->ticket->setEvent($this->event);
        $em->persist($this->ticket);

    }

}