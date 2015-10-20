<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, Array $options){
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('billingAddress', new BillingAddressType() )
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Customer',
        ));
    }

    public function getName(){
        return 'customer';
    }

}