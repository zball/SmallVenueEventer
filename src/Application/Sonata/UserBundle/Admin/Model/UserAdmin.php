<?php
/**
 * Created by PhpStorm.
 * User: zacball
 * Date: 9/19/15
 * Time: 1:08 AM
 */

namespace Application\Sonata\UserBundle\Admin\Model;


use Sonata\UserBundle\Admin\Model\UserAdmin as SonataUserAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class UserAdmin extends SonataUserAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);

        $formMapper
            ->with('Venues')
            ->end()
        ;
    }


}