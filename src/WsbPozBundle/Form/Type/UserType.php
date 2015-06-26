<?php

namespace WsbPozBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('imie', 'text');
        $builder->add('nazwisko', 'text');
        $builder->add('username', 'text');
        $builder->add('email', 'email');
        $builder->add('plainPassword', 'repeated', array(
            'first_name'  => 'password',
            'second_name' => 'confirm',
            'type'        => 'password',
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WsbPozBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'user';
    }
}
