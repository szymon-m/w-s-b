<?php

namespace WsbPozBundle\Form\Model;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class UserRegistration extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('imie', 'text');
        $builder->add('nazwisko', 'text');
        $builder->add('username', 'text');
        $builder->add('email', 'email');
        $builder->add('password', 'repeated', array(
            'first_name'  => 'Password',
            'second_name' => 'Confirm',
            'type'        => 'password',));
        $builder->add(
            'Newsletter',
            'checkbox',
            array('property_path' => 'newsletter')
        );
        $builder->add('Zarejestruj', 'submit');

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'user';
    }
}
