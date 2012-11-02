<?php

namespace ChristianSoronellas\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('name')
            ->add('email')
            ->add('body', 'textarea', array('attr' => array('rows' => 10)))
        ;
    }

    public function getName()
    {
        return 'christiansoronellas_blogbundle_contacttype';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $constraints = new Collection(array(
            'email' => array(
                new NotBlank(),
                new Email()
            ),
            'body' => new NotBlank()
        ));

        $resolver->setDefaults(array(
            'constraints' => $constraints
        ));
    }
}
