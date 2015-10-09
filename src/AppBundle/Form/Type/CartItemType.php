<?php

namespace AppBundle\Form\Type;

use Sylius\Bundle\CartBundle\Form\Type\CartItemType as BaseCartItemType;
use Symfony\Component\Form\FormBuilderInterface;

class CartItemType extends BaseCartItemType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options); // Add default fields.
    }
}