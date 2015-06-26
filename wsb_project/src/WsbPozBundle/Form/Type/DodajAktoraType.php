<?php

namespace WsbPozBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DodajAktoraType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('imie','text')
            ->add('nazwisko','text')
            ->add('Zapisz','submit')
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WsbPozBundle\Entity\Aktorzy'
        ));
    }

    public function getName()
    {
        return 'dodaj_aktora';
    }
}
