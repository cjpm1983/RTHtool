<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class UserAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('username')
            ->add('usernameCanonical')
            ->add('email')
            ->add('emailCanonical')
            ->add('enabled')
            ->add('salt')
            ->add('password')
            ->add('lastLogin')
            ->add('locked')
            #->add('expired')
            #->add('expiresAt')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            ->add('roles')
            #->add('credentialsExpired')
            #->add('credentialsExpireAt')
            ->add('id')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('username')
            #->add('usernameCanonical')
            ->add('email')
            #->add('emailCanonical')
            ->add('enabled')
            #->add('salt')
            #->add('password')
            #->add('lastLogin')
            ->add('locked')
            #->add('expired')
            #->add('expiresAt')
            #->add('confirmationToken')
            #->add('passwordRequestedAt')
            ->add('roles')
            #->add('credentialsExpired')
            #->add('credentialsExpireAt')
            #->add('id')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('username')
                ->add('email')
                ->add('plainPassword', 'text')
            ->end()
            #->with('Groups')
                #->add('groups')#, 'sonata_type_model', array('required' => false))
            #->end()
            ->with('Management')
                ->add('roles')#, 'sonata_security_roles', array( 'multiple' => true))
                ->add('locked', null, array('required' => false))
                ->add('expired', null, array('required' => false))
                ->add('enabled', null, array('required' => false))
                #->add('credentialsExpired', null, array('required' => false))
            ->end()
            ->add('lastLogin')
            
            #->add('expired')
            #->add('expiresAt')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            
            #->add('credentialsExpired')
            #->add('credentialsExpireAt')
            #->add('id')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('username')
            ->add('usernameCanonical')
            ->add('email')
            ->add('emailCanonical')
            ->add('enabled')
            ->add('salt')
            ->add('password')
            ->add('lastLogin')
            ->add('locked')
            #->add('expired')
            #->add('expiresAt')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            ->add('roles')
            #->add('credentialsExpired')
            #->add('credentialsExpireAt')
            ->add('id')
        ;
    }
}
