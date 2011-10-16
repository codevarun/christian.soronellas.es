<?php

namespace ChristianSoronellas\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name', 'text')
                ->add('email', 'email')
                ->add('website', 'url')
                ->add('parentComment', 'entity_id', array(
                    'class' => 'ChristianSoronellas\BlogBundle\Entity\Comment'    
                ))
                ->add('body', 'textarea', array(
                    'label' => 'Comment',
                    'attr' => array(
                        'rows' => 10,
                        'cols' => 100
                    )
                ));
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
