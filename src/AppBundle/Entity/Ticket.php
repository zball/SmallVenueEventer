<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vivait\StringGeneratorBundle\Annotation\GeneratorAnnotation as Generate;
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
     * @Generate(generator="secure_string")
     */
    private $barcode;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="tickets")
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
     */
    public function setEvent($event)
    {
        $this->event = $event;
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
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
    }
}
