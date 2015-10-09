<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Product;

/**
 * InventoryUnit
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class InventoryUnit {

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
     * @ORM\Column(name="available", type="integer")
     */
    private $available;

    /**
     * @ORM\OneToOne(targetEntity="Product", inversedBy="inventoryUnit")
     **/
    private $product;

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @return InventoryUnit
     * @param mixed $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
        return $this;
    }



    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return InventoryUnit
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * @return InventoryUnit
     * @param int $available
     */
    public function setAvailable($available)
    {
        $this->available = $available;
        return $this;
    }

}