<?php

namespace AppBundle\Listener;

use AppBundle\Factory\ProductFactoryInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\Event;


class EventListener {

    private $ticketFactory;

    public function __construct(ProductFactoryInterface $pfi)
    {
        $this->ticketFactory = $pfi;
    }

    public function prePersist(Event $event, LifecycleEventArgs $args){
        $ticket = $this->createTicket($event);
        $this->persistTicket($args, $ticket);
    }

    /**
     * @param Event $event
     * @return mixed
     */
    public function createTicket(Event $event)
    {
        $ticketData = [
            'price' => $event->getTicketPrice(),
            'event' => $event
        ];
        $ticket = $this->ticketFactory->create($ticketData);
        return $ticket;
    }

    /**
     * @param LifecycleEventArgs $args
     * @param $ticket
     */
    public function persistTicket(LifecycleEventArgs $args, $ticket)
    {
        $em = $args->getEntityManager();
        $em->persist($ticket);
    }


}