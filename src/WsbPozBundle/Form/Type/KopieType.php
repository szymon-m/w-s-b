<?php

namespace WsbPozBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KopieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('kopie', 'entity', array(
                'class' => 'WsbPozBundle:Filmy',
                'label' => 'Wybierz film: ',
            )
        )
            //->add('wybierz', 'submit', array(
            //    'label' => 'Wybierz',
            //))
            ->getForm();

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {

            $form = $event->getForm();
            $data = $event->getData();
            //$filmyIdFilmu = $data->getFilmyIdFilmu();
      });
    }


    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'kopie';
    }
}


