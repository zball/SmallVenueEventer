<?php
/**
 * Created by PhpStorm.
 * User: zacball
 * Date: 9/15/15
 * Time: 1:29 AM
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class VenueAdmin extends Admin{

    protected function configureFormFields(FormMapper $formMapper){

        // Fields to be shown on create/edit forms
        $formMapper
            ->add('name', 'text', ['label' => 'Venue Name'])
            ->add('address', 'text', ['label' => 'Address'])
            ->add('city', 'text', ['label' => 'City'])
            ->add('state', 'text', ['label' => 'State'])
            ->add('zip', 'text', ['label' => 'Zip'])
            ->add('user', 'sonata_type_model_autocomplete', ['property' => 'username'])
        ;

    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper){

        $datagridMapper
            ->add('name')
            ->add('address')
        ;

    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('address')
            ->add('city')
        ;
    }

}