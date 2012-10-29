<?php

namespace ChristianSoronellas\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('body')
            ->add('slug')
            ->add('created_at')
            ->add('updated_at')
            ->add('commentsEnabled')
            ->add('state')
            ->add('tags')
        ;
    }

    public function getName()
    {
        return 'christiansoronellas_blogbundle_posttype';
    }
}
