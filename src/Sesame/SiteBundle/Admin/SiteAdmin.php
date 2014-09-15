<?php

namespace Sesame\SiteBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class SiteAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General', array(
                    'class' => 'col-md-6'
                ))
                ->add('title', 'text', array('label' => 'Titre du site'))
                ->add('description', 'textarea', array('label' => 'Description'))
                ->add('excerpt', 'textarea', array('label' => 'Excerpt'))
            ->end()
            ->with('Infos', array(
                    'class' => 'col-md-6'
                ))
                ->add('gauid', 'text', array('label' => 'Google Analitycs ID'))
            ->end()
            ->with('Image', array(
                    'class' => 'col-md-6'
                ))
                ->add('gallery', 'sonata_type_model_list', 
                    array(
                        'required' => false,
                        'by_reference' => true,
                        ),
                    array(
                        'edit' => 'standard',
                        'inline' => 'table',
                    )) //if no type is specified, SonataAdminBundle tries to guess it
            ->end()           
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('gauid')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('gauid')
        ;
    }
}