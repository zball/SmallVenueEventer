<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Product;

/**
 * Ticket
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\TicketRepository")
 */
class Ticket extends Product
{
    /**
     * @var integer
     *
     * @ORM\Column(name="barcode")
     */
    private $barcode;

    /**
     * @return int
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * @param int $barcode
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
    }
}
