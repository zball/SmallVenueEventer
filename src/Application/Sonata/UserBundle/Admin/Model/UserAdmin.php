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
        $formMapper
            ->tab('General')->with('Basic Info')
            ->add('username')
            ->add('email')
            ->add('plainPassword', 'text', array(
                'required' => (!$this->getSubject() || is_null($this->getSubject()->getId()))
            ))
            ->end()->end();


            $formMapper->tab('Groups & Roles')
                ->with('Groups')
                    ->add('groups', 'sonata_type_model', array(
                        'required' => false,
                        'expanded' => true,
                        'multiple' => true
                    ))
                    ->end();
        if ($this->getSubject() && !$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
            $formMapper
                ->with('Roles')
                ->add('realRoles', 'sonata_security_roles', array(
                    'label'    => 'form.label_roles',
                    'expanded' => true,
                    'multiple' => true,
                    'required' => false
                ))
                ->add('locked', null, array('required' => false))
                ->add('expired', null, array('required' => false))
                ->add('enabled', null, array('required' => false))
                ->add('credentialsExpired', null, array('required' => false))
                ->end();
            ;
        }

            $formMapper->end()
            ->tab('Info')->with('Profile')
            ->add('dateOfBirth', 'birthday', array('required' => false))
            ->add('firstname', null, array('required' => false))
            ->add('lastname', null, array('required' => false))
            ->add('website', 'url', array('required' => false))
            ->add('biography', 'text', array('required' => false))
            ->add('gender', 'sonata_user_gender', array(
                'required' => true,
                'translation_domain' => $this->getTranslationDomain()
            ))
            ->add('locale', 'locale', array('required' => false))
            ->add('timezone', 'timezone', array('required' => false))
            ->add('phone', null, array('required' => false))
            ->end()
            ->with('Social')
            ->add('facebookUid', null, array('required' => false))
            ->add('facebookName', null, array('required' => false))
            ->add('twitterUid', null, array('required' => false))
            ->add('twitterName', null, array('required' => false))
            ->add('gplusUid', null, array('required' => false))
            ->add('gplusName', null, array('required' => false))
            ->end()->end()
        ;


        $formMapper
            ->tab('Security')->with('Two Step Verification')
            ->add('token', null, array('required' => false))
            ->add('twoStepVerificationCode', null, array('required' => false))
            ->end()->end();
        ;

        $formMapper->tab('Venues')
            ->add('venues', 'sonata_type_collection', ['label' => 'Venues'])
            ->end();
    }


}
