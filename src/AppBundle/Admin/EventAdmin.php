<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EventAdmin extends Admin{

    protected function configureFormFields(FormMapper $formMapper){

        // Fields to be shown on create/edit forms
        $formMapper
            ->add('title', 'text', ['label' => 'Title'])
            ->add('venue', 'sonata_type_model_autocomplete', [
                'property' => 'name',
                'attr' => ['style' => 'width:300px'],
                'to_string_callback' => function($entity, $property){
                    return $entity->getName();
                }
            ])
            ->add('eventStart', 'sonata_type_datetime_picker')
            ->add('eventEnd', 'sonata_type_datetime_picker')
            ->add('minAge', 'choice', [
                'choices' => [
                    'all_ages' => 'All Ages',
                    '13' => '13',
                    '16' => '16',
                    '18' => '18',
                    '21' => '21'
                ],
                'data' => 'all_ages'
            ])
            ->add('maxCapacity')

        ;

    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper){

        $datagridMapper
            ->add('title')
            ->add('venue')
            ->add('eventStart', 'doctrine_orm_date', ['field_type' => 'sonata_type_date_picker'])
        ;

    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper){
        $listMapper
            ->addIdentifier('title')
            ->add('venue')
            ->add('eventStart')
        ;
    }

}