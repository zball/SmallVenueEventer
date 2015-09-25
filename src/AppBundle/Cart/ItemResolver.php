<?php
/**
 * Created by PhpStorm.
 * User: zacball
 * Date: 9/22/15
 * Time: 3:48 AM
 */

namespace AppBundle\Cart;

use Sylius\Component\Cart\Model\CartItemInterface;
use Sylius\Component\Cart\Resolver\ItemResolverInterface;
use Doctrine\ORM\EntityManager;

class ItemResolver implements ItemResolverInterface
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function resolve(CartItemInterface $item, $request)
    {
    }

    private function getProductRepository()
    {
        //return $this->entityManager->getRepository('AppBundle:Product');
    }
}