<?php

namespace WsbPozBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WsbPozBundle\Entity\Aktorzy;
use WsbPozBundle\Entity\Filmy;
use WsbPozBundle\Form\Type\DodajAktoraType;
use WsbPozBundle\Form\Type\DodajFilmType;

class AdminController extends Controller
{
    /**
     * @Route("/admin/filmy", name="filmy")
     * @Template("WsbPozBundle:Admin:filmy.html.twig")
     */
    public function filmyAction()
    {
        if(!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException();
        } else {
            $user = $this->getUser();
        }

        $filmy = $this->getDoctrine()
            ->getRepository('WsbPozBundle:Filmy')
            ->findAll();

        return array('filmy' => $filmy);
    }

    /**
     * @Route("/admin/nowy_film", name="nowy_film")
     * @Template("WsbPozBundle:Admin:nowy_film.html.twig")
     */
    public function nowy_filmAction()
    {
            $film = new Filmy();
            $form = $this->createForm(new DodajFilmType(), $film, array(
                'action' => $this->generateUrl('dodaj_film'),
        ));

        return array('form' => $form->createView());

    }
    /**
     * @Route("/admin/dodaj_film", name="dodaj_film")
     * @Template("WsbPozBundle:Admin:dodaj_film.html.twig")
     */
    public function dodaj_filmAction(Request $request)
    {
        $film = new Filmy();
        $form = $this->createForm(new DodajFilmType(), $film);

        $form->handleRequest($request);
        $form->createView();
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $filmek = $form->getData();
            $em->persist($filmek);
            $em->flush();

            return array('filmek' => $filmek);

        } else {
            return $this->redirectToRoute('nowy_film');
        }

    }



    /**
     * @Route("/admin/usun_film/{id}", name="usun_film")
     * @Template("WsbPozBundle:Admin:usun_film.html.twig")
     */
    public function usun_filmAction($id)

    {
        $em = $this->getDoctrine()->getManager();
        $film = $em->getRepository('WsbPozBundle:Filmy')->find($id);
        if (!$film) {
            throw $this->createNotFoundException(
                'Niestety nie ma takiego filmu' . $id
            );
        }

            $em->remove($film);
            $em->flush();

        return array('film' => $film);

    }

    /**
     * @Route("/admin/zmien_obsade")
     * @Template()
     */
    public function zmien_obsadeAction()
    {
        return array(
                // ...
            );    }
    /**
     * @Route("/admin/aktorzy", name="aktorzy")
     * @Template("WsbPozBundle:Admin:aktorzy.html.twig")
     */
    public function aktorzyAction()
    {
        if(!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException();
        } else {
            $user = $this->getUser();
        }

        $aktorzy = $this->getDoctrine()
            ->getRepository('WsbPozBundle:Aktorzy')
            ->findAll();

        return array('aktorzy' => $aktorzy);
    }


    /**
     * @Route("/admin/nowy_aktor", name="nowy_aktor")
     * @Template("WsbPozBundle:Admin:nowy_aktor.html.twig")
     */
    public function nowy_aktorAction()
    {
        $aktor = new Aktorzy();
        $form = $this->createForm(new DodajAktoraType(), $aktor, array(
            'action' => $this->generateUrl('dodaj_aktora'),
        ));

        return array('form' => $form->createView());
    }

    /**
     * @Route("/admin/dodaj_aktora", name="dodaj_aktora")
     * @Template("WsbPozBundle:Admin:dodaj_aktora.html.twig")
     */
    public function dodaj_aktoraAction(Request $request)
    {
        $aktor = new Aktorzy();
        $form = $this->createForm(new DodajAktoraType(), $aktor);

        $form->handleRequest($request);
        $form->createView();
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $nowy_aktor = $form->getData();
            $em->persist($nowy_aktor);
            $em->flush();

            return array('nowy_aktor' => $nowy_aktor);

        } else {
            return $this->redirectToRoute('nowy_aktor');
        }   }



    /**
     * @Route("/admin/usun_aktora/{id}", name="usun_aktora")
     * @Template("WsbPozBundle:Admin:usun_aktora.html.twig")
     */
    public function usun_aktoraAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $aktor = $em->getRepository('WsbPozBundle:Aktorzy')->find($id);
        if (!$aktor) {
            throw $this->createNotFoundException(
                'Niestety nie ma takiego aktora' . $id
            );
        }

        $em->remove($aktor);
        $em->flush();

        return array('aktor' => $aktor);
    }

    /**
     * @Route("/admin/kopie", name="kopie")
     * @Template("WsbPozBundle:Admin:kopie.html.twig")
     */
    public function kopieAction()
    {
        $em = $this->getDoctrine()->getManager();
        $kopie = $em->getRepository('WsbPozBundle:Kopie')->findAll();
        if (!$kopie) {
            throw $this->createNotFoundException(
                'Niestety nie ma żadnych kopii'
            );
        }


        return array('kopie' => $kopie);

    }


/*$builder->add('regions', 'entity', array(
'class' => 'ReuzzeReuzzeBundle:Regions',
'property' => 'regionName',
'expanded' => false,
'multiple' => false
));*/
}
