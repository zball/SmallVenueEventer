<?php

namespace AppBundle\Form\Type;

use Sylius\Bundle\CartBundle\Form\Type\CartType as BaseCartType;
use Symfony\Component\Form\FormBuilderInterface;

class CartType extends BaseCartType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options); // Add default fields.
    }
}