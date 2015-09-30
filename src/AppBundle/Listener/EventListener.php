<?php

namespace AppBundle\Listener;

use AppBundle\Model\TicketManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Event;


class EventListener {

    private $ticketManager;

    public function __construct(TicketManagerInterface $tm){
        $this->ticketManager = $tm;
    }

    public function prePersist(Event $event, LifecycleEventArgs $args){

        $em = $args->getEntityManager();

        $ticket = $this->ticketManager->createTicket();

        $ticket->setBarcode(785885);
        $ticket->setPrice(15.50);
        $ticket->setEvent($event);

        $em->persist($ticket);

    }


}