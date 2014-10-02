<?php

namespace Omkom\AdminBundle;

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
                    'class' => 'col-sm-12 col-md-4'
                ))
                ->add('title', 'text', array('label' => 'Titre du site'))
                ->add('logo')
                ->add('description', 'textarea', array('label' => 'Description'))
                ->add('excerpt', 'textarea', array('label' => 'Excerpt'))
            ->end()
            ->with('Infos', array(
                    'class' => 'col-md-6'
                ))
                ->add('gauid', 'text', array('label' => 'Google Analitycs ID'))
            ->end()
            ->with('Societe', array(
                    'class' => 'col-sm-12 col-md-4'
                ))
                ->add('societe', 'sonata_type_model_list', 
                    array(
                        'required' => false,
                        'by_reference' => true,
                        ),
                    array(
                        'edit' => 'standard',
                        'inline' => 'table',
                    ))
            ->end()    
            ->with('Image', array(
                    'class' => 'col-sm-12 col-md-4'
                ))
                ->add('image', 'sonata_type_model_list', 
                    array(
                        'required' => false,
                        'by_reference' => true,
                        ),
                    array(
                        'edit' => 'standard',
                        'inline' => 'table',
                    ))
                ->add('gallery', 'sonata_type_model_list', 
                    array(
                        'required' => false,
                        'by_reference' => true,
                        ),
                    array(
                        'edit' => 'standard',
                        'inline' => 'table',
                    ))
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