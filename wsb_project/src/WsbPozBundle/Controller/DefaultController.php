<?php

namespace WsbPozBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WsbPozBundle\Entity\Aktorzy;
use WsbPozBundle\Entity\Filmy;
use WsbPozBundle\Entity\Kontakt;
use WsbPozBundle\Entity\User;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="hello")
     * @Template()
     */
    public function indexAction($name)
    {
        /*if(!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        } else {
            $user = $this->getUser();
        }*/

        $filmy = $this->getDoctrine()
            ->getRepository('WsbPozBundle:Filmy')
            ->find(1);

        $filmy_aktora = $filmy->getAktorzyAktora();

        /*
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('WsbPozBundle:User');
        $query = $repository->createQueryBuilder('u')
            ->innerJoin('u.groups', 'g')
            ->where('g.id = :group_id')
            ->setParameter('group_id', 5)
            ->getQuery()->getResult();*/
        return array('filmy' => $filmy, 'filmy_aktora' => $filmy_aktora);
    }
    /**
     * @Route("/filmy", name="filmy")
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
     * @Route("/oferta", name="oferta")
     * @Template("WsbPozBundle:Default:oferta.html.twig")
     */
    public function ofertaAction() {

        /*if(!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        } else {
            $user = $this->getUser();
        }*/
        $filmy = $this->getDoctrine()
            ->getRepository('WsbPozBundle:Filmy')
            ->findAll();

        return array('filmy' => $filmy);
    }


    /**
     * @Route("/kontakt", name="kontakt")
     * @Template("WsbPozBundle:Default:kontakt.html.twig")
     */
    public function kontaktAction(Request $request) {

        $kontakt = new Kontakt();

        $kontakt->setDataWprowadzenia(new \DateTime('today'));

        $form = $this->createFormBuilder($kontakt)
            ->add('email', 'email', array('label' => 'E-mail',))
            ->add('tresc', 'textarea', array('data' => 'Tutaj wpisz tekst zgłoszenia','label' => 'Treść zgłoszenia',))
            ->add('data_wprowadzenia', 'date')
            ->add('save', 'submit', array('label' => 'Zapisz'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $tresc = $form->getData();
            $em->persist($tresc);
            $em->flush();
            $this->addFlash('notice', 'Dodano nowe zgłoszenie!');

            return $this->redirectToRoute('hello');
        }

        return array('form' => $form->createView());
    }

}
