<?php

namespace WsbPozBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DodajFilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tytul','text')
            ->add('rok_produkcji','integer')
            ->add('cena','number')
            ->add('Zapisz','submit')
            ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WsbPozBundle\Entity\Filmy'
        ));
    }

    public function getName()
    {
        return 'dodaj_film';
    }
}
