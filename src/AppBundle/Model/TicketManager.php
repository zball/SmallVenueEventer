<?php

namespace AppBundle\Model;

use AppBundle\Entity\Ticket;


class TicketManager implements TicketManagerInterface{

    /**
     * {@inheritdoc}
     */
    public function createTicket(){

        $ticket = new Ticket();
        return $ticket;

    }
}