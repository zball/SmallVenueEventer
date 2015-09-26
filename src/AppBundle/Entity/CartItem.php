<?php
/**
 * Created by PhpStorm.
 * User: zacball
 * Date: 9/22/15
 * Time: 3:42 AM
 */

namespace AppBundle\Entity;

use Sylius\Component\Cart\Model\CartItem as BaseCartItem;
use Doctrine\ORM\Mapping as ORM;

/**
 * Event
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
}
