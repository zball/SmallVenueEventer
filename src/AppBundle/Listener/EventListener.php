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

        $em = $args->getEntityManager();

        $ticketData = [
            'price' => $event->getTicketPrice(),
            'event' => $event,
            'barcode' => 497598347593729875
        ];
        $ticket = $this->ticketFactory->create($ticketData);

        $em->persist($ticket);

    }


}