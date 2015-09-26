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
    private $product;

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct(Product $product)
    {
        $this->product = $product;
    }

}