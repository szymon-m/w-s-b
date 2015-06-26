<?php

namespace WsbPozBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use WsbPozBundle\Entity\Filmy_has_Aktorzy;

class DodajAktoraDoFilmu extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*$builder->add('film','entity', array(
            'class' => 'WsbPozBundle:Filmy',
            //'mapped' => false,

        ))
            ->add('wybierz','submit', array(
                'label'=> 'Wybierz',
            ))
            ->getForm();
        */
        $builder->add('filmyIdFilmu', 'entity', array(
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
                $filmyIdFilmu = $data->getFilmyIdFilmu();

                //$form->add('aktorzyIdAktora', 'entity', array(
                //    'class' => 'WsbPozBundle:Aktorzy',
                //));



        });




        /*$builder ======================================================
            ->add('films', 'entity', array(
                'class'       => 'WsbPozBundle:Filmy',
                'placeholder' => '',
                'multiple' => true,
                'expanded' => false,
            ));


        $builder->addEventListener(FormEvents::PRE_SET_DATA,
            function (FormEvent $event) {
                $form = $event->getForm();

                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();

                $film = $data->getFilms();
                //$actors = null === $films ? array() : $films->getAktorzyAktora();

                $form->add('aktorzyAktora', 'entity', array(
                    'class'       => 'WsbPozBundle:Aktorzy',
                    'placeholder' => '',
                    //'choices'     => $actors,
                ));

            }
    );
         $builder->add('wybierz','submit', array(
             'label'=> 'Wybierz',
         ));*/

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        //$resolver->setDefaults(array(
         //   'data_class' => 'WsbPozBundle\Entity\Filmy_has_Aktorzy',
        //));
    }

    public function getName()
    {
        return 'aktora_do_filmu';
    }
}
