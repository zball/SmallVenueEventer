<?php
namespace AppBundle\Model;

interface TicketManagerInterface {

    /**
     * Creates an empty ticket instance
     *
     * @return Ticket
     */
    public function createTicket();



}