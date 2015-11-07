<?php

namespace AppBundle\Factory;

use AppBundle\Entity\Ticket;

class TicketFactory implements ProductFactoryInterface{

    public function create(Array $ticketData){

        $ticket = new Ticket();

        $ticket->setEvent($ticketData['event']);
        $ticket->setPrice($ticketData['price']);
        return $ticket;
    }

}