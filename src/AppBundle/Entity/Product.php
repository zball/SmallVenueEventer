<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"product" = "AppBundle\Entity\Product", "ticket" = "AppBundle\Entity\Ticket"})
 */

class Product {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="decimal", scale=2)
     */
    private $price;

    /**
     * @ORM\OneToOne(targetEntity="InventoryUnit", mappedBy="product")
     **/
    private $inventoryUnit;


    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getInventoryUnit()
    {
        return $this->inventoryUnit;
    }

    /**
     * @return InventoryUnit
     * @param mixed $inventoryUnit
     */
    public function setInventoryUnit($inventoryUnit)
    {
        $this->inventoryUnit = $inventoryUnit;
    }

}