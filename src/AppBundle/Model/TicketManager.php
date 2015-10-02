<?php

namespace AppBundle\Model;

use AppBundle\Entity\Ticket;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;


class TicketManager implements TicketManagerInterface{

    private $entityManager;

    /**
     * {@inheritdoc}
     */
    public function createTicket(){

        $ticket = new Ticket();
        return $ticket;

    }

    public function setEntityManager(EntityManager $em){
        $this->entityManager = $em;
    }
}