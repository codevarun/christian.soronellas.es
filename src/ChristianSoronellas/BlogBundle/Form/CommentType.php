<?php

namespace ChristianSoronellas\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('body')
            ->add('state')
            ->add('created_at')
            ->add('updated_at')
            ->add('category')
        ;
    }

    public function getName()
    {
        return 'christiansoronellas_blogbundle_commenttype';
    }
    
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class'      => 'ChristianSoronellas\BlogBundle\Entity\Comment',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            // a unique key to help generate the secret token
            'intention'       => 'comment_item',
        );
    }
}
