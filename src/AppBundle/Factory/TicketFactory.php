<?php

namespace AppBundle\Factory;

use AppBundle\Entity\Ticket;

class TicketFactory implements ProductFactoryInterface{

    public function create(Array $ticketData){

        $ticket = new Ticket();
        $ticket
            ->setPrice($ticketData['price'])
            ->setEvent($ticketData['event']);
        return $ticket;
    }

}