<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class HammerpostAdmin extends AbstractAdmin
{
    
    
      protected function configureRoutes(\Sonata\AdminBundle\Route\RouteCollection $collection)
    {    
    $collection->add('editor');
    $collection->add('html');
    }
    
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            //->add('id')
                
            ->add('titulo', null, array('label' =>'Title'))
            ->add('fechaCreado', 'doctrine_orm_date_range', array(
                'field_type' => 'sonata_type_date_range_picker','label' =>'Date'))
            ->add('post')
                
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            //->add('id')
            ->add('titulo', null, array('label' =>'Title'))
            ->add('fechaCreado','date',array('label' =>'Date'))
            //->add('post')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array('template' => 'AppBundle:CRUD:list__action_show.html.twig'),
                    //'edit' => array(),
                    'html'=> array('template' => 'AppBundle:CRUD:list__action_html.html.twig'),
                    'list'=> array('template' => 'AppBundle:CRUD:list__action_editor.html.twig'),
                    'delete'=> array('template' => 'AppBundle:CRUD:list__action_delete.html.twig'),
                    
                    
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
            //->add('id')
            ->add('titulo', null, array('label' =>'Title'))
            ->add('fechaCreado', 'sonata_type_date_picker',array('html5'=>false,'format'=>'yyyy-MM-dd','label'=>'Date'))
            //->add('post',null,array('required'=>false))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            //->add('id')
            ->add('titulo', null, array('label' =>'Title'))
            ->add('fechaCreado', null,array('label'=>'Date'))
            ->add('post','html',array('label'=>'Post'))
        ;
    }
}
