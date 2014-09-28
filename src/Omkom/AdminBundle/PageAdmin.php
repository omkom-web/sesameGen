<?php
namespace Omkom\AdminBundle;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PageAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General', array(
                    'class' => 'col-md-6'
                ))
                ->add('title', 'text', array('label' => 'Titre de la page'))
                // ->add('slug', 'text', array('label' => 'slug'))
                ->add('description', 'textarea', array('label' => 'Description'))
                ->add('excerpt', 'textarea', array('label' => 'Excerpt'))
                // ->add('author', 'entity', array('class' => 'Omkom\SiteBundle\Entity\User'))
                ->add('body')
                ->add('body', 'ckeditor', array(
                'config' => array(
                    'toolbar' => array(
                        array(
                            'name'  => 'document',
                            'items' => array('Source', '-', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates'),
                        ),
                        '/',
                        array(
                            'name'  => 'basicstyles',
                            'items' => array('Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'),
                        ),
                    ),
                    'uiColor' => '#ffffff',
                    //...
                ),
            ))
            ->end()
            ->with('Publication', array (
                    'class' => 'col-md-6'
                ))
                ->add('active', null, array('required' => false))
            ->end()
            ->with('Image', array(
                    'class' => 'col-md-6'
                ))
                ->add('media', 'sonata_type_model_list', 
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
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('active', null, array('editable' => true))
            ->addIdentifier('title')
            ->add('viewcount')
            ->add('slug')
            ->add('updated')
        ;
    }
}