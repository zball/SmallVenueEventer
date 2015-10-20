<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BillingAddressType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, Array $options){
        $builder
            ->add('streetAddress')
            ->add('city')
            ->add('state')
            ->add('zip')
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\BillingAddress',
        ));
    }

    public function getName(){
        return 'billing_address';
    }

}