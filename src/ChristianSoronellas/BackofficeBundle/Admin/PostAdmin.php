<?php

namespace ChristianSoronellas\BackofficeBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PostAdmin extends Admin
{
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('title')
        ;
    }

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('title')
            ->add('body')
        ;
        
    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('title')
            ->add('created_at')
            ->add('updated_at')
        ;
    }


    protected function configureShowFields(ShowMapper $filter)
    {
        $filter
            ->add('id')
            ->add('title')
        ;
    }

    
}