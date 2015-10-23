<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vivait\StringGeneratorBundle\Annotation\GeneratorAnnotation as Generate;
use AppBundle\Entity\StockableProductInterface;
use AppBundle\Entity\Product;

/**
 * Ticket
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\TicketRepository")
 */
class Ticket extends Product implements StockableProductInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="barcode")
     * @Generate(generator="secure_string")
     */
    private $barcode;

    /**
     * @ORM\OneToOne(targetEntity="Event", inversedBy="ticket")
     **/
    private $event;



    /**
     * @return int
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * @param int $barcode
     * @return Ticket
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
        return $this;
    }

    /**
     * Set event
     *
     * @param \AppBundle\Entity\Event $event
     * @return Ticket
     */
    public function setEvent(\AppBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \AppBundle\Entity\Event 
     */
    public function getEvent()
    {
        return $this->event;
    }
}
