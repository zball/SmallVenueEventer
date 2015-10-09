<?php

namespace AppBundle\Entity;

use Sylius\Component\Cart\Model\CartItem as BaseCartItem;
use Doctrine\ORM\Mapping as ORM;

/**
 * Cart Item
 *
 * @ORM\Table(name="app_cart_item")
 * @ORM\Entity
 */
class CartItem extends BaseCartItem
{
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ticket")
     */
    private $ticket;


    /**
     * Set ticket
     *
     * @param \AppBundle\Entity\Ticket $ticket
     * @return CartItem
     */
    public function setTicket(\AppBundle\Entity\Ticket $ticket = null)
    {
        $this->ticket = $ticket;

        return $this;
    }

    /**
     * Get ticket
     *
     * @return \AppBundle\Entity\Ticket 
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * {@inheritdoc}
     */
    public function setUnitPrice($unitPrice)
    {
        if (!is_float($unitPrice)) {
            throw new \InvalidArgumentException('Unit price must be an integer.');
        }
        $this->unitPrice = $unitPrice;

        return $this;
    }
}
