<?php

namespace ChristianSoronellas\BackofficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use ChristianSoronellas\BlogBundle\Entity\Post;

class PostType extends AbstractType
{
    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'christiansoronellas_backofficebundle_posttype';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('body', 'textarea')
            ->add('commentsEnabled', 'checkbox')
            ->add('state', 'choice', array(
                'required' => false,
                'choices' => array(Post::STATE_DRAFT => 'Borrador', Post::STATE_COMPLETE => 'Completada'),
                'empty_value' => 'Elige un estado'
            ))
        ;
    }
}