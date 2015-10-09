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
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     * @return Ticket
     */
    public function setEvent($event)
    {
        $this->event = $event;
        return $this;
    }

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
}
