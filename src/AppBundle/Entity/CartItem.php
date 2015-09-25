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
 * @ORM\Table()
 * @ORM\Entity
 */
class CartItem extends BaseCartItem
{
}