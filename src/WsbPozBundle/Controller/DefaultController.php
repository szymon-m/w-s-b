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
use WsbPozBundle\Entity\Kopie;
use WsbPozBundle\Entity\User;
use WsbPozBundle\Entity\Wypozyczenia;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="hello")
     * @Template("WsbPozBundle:Default:index.html.twig")
     */
    public function indexAction()
    {

        return $this->render(
            'WsbPozBundle:Default:index.html.twig'
        );

        /*if(!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        } else {
            $user = $this->getUser();
        }

        $filmy = $this->getDoctrine()
            ->getRepository('WsbPozBundle:Filmy')
            ->find(1);

        $filmy_aktora = $filmy->getAktorzyAktora();


        return array('filmy' => $filmy, 'filmy_aktora' => $filmy_aktora);
        */ /* ==========================================================================
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(      // działa również na dwóch zmiennych
            'SELECT f, a
              FROM WsbPozBundle:Filmy f
              JOIN f.aktorzyAktora a
              ORDER BY f.idFilmu ASC'
        );============================================================================== */
        /*$query = $em->createQuery(
            'SELECT a, f
              FROM WsbPozBundle:Aktorzy a
              JOIN a.filmyFilmu f
              ORDER BY a.idAktora ASC'
        );*/
        //$filmy_aktora = $query->getResult();
        //$aktor_w_filmie = $query->getResult();
        //return array('filmy' => $filmy, 'filmy_aktora' => $filmy_aktora);
        //return array('filmy_aktora' => $filmy_aktora);
        //return array('aktor_w_filmie' => $aktor_w_filmie);
// to get just one result:
// $product = $query->setMaxResults(1)->getOneOrNullResult();
    }


    /**
     * @Route("/oferta", name="oferta")
     * @Template("WsbPozBundle:Default:oferta.html.twig")
     */
    public function ofertaAction() {

        /*$em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(      // działa również na dwóch zmiennych
            'SELECT f, a
              FROM WsbPozBundle:Kopie f
              JOIN f.idFilmu a
              GROUP BY f.idFilmu'
        ); */

        /*$query = $em->createQuery(
            'SELECT a, f
              FROM WsbPozBundle:Aktorzy a
              JOIN a.filmyFilmu f
              ORDER BY a.idAktora ASC'
        );*/


        //$dane = $query->getResult();
        $filmy = $this->getDoctrine()
            ->getRepository('WsbPozBundle:Filmy')
            ->findAll();
        /*if(!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        } else {
            $user = $this->getUser();
        }*/
        //exit(\Doctrine\Common\Util\Debug::dump($dane));
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
    /**
     * @Route("/wypozycz", name="wypozycz")
     * @Template("WsbPozBundle:Default:wypozycz.html.twig")
     */
    public function wypozyczAction(Request $request) {

        //$request = Request::createFromGlobals();

        //$id_filmu = $request->request->get('_GET');
        $id_filmu = (int)$_GET['id_filmu'];
        if(!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        } else {
            $user = $this->getUser();
        }

        $app_user_id = $user->getId();
        $dostepna = '1';

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT k
                 FROM WsbPozBundle:Kopie k
                  WHERE k.idFilmu = :id_filmu
                  AND k.czyDostepna = 1'
            )
            ->setParameter('id_filmu', $id_filmu);
        $kopie = $query->getResult();
        //exit(\Doctrine\Common\Util\Debug::dump($kopie));

        if(!$kopie) {

           $request->getSession()
                ->getFlashBag()
                ->add('failure', 'Niestety nie mamy więcej kopii!');

            return $this->redirectToRoute('oferta');
        } else  {

            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                'SELECT k
                 FROM WsbPozBundle:Kopie k
                  WHERE k.idFilmu = :id_filmu
                  AND k.czyDostepna = :dostepna'
            )->setParameters(array('id_filmu'=> $id_filmu,'dostepna'=> $dostepna ));


            $pierwsza_kopia = $query->getResult();
            //exit(\Doctrine\Common\Util\Debug::dump($pierwsza_kopia));
            $id_kopii = $pierwsza_kopia[0]->getIdKopii();


            $film = $this->getDoctrine()
                ->getRepository('WsbPozBundle:Filmy')
                ->find($id_filmu);

            $kopia = $this->getDoctrine()
                ->getRepository('WsbPozBundle:Kopie')
                ->find($id_kopii);

            $uzytkownik = $this->getDoctrine()
                ->getRepository('WsbPozBundle:User')
                ->find($app_user_id);

            //exit(\Doctrine\Common\Util\Debug::dump($id_kopii));

            $kopia->setCzyDostepna('0');


            $dane = new Wypozyczenia();
            $dane->setKopieKopii($kopia);
            $dane->setAppUsers($uzytkownik);
            $dane->setDataWypozyczenia(new \DateTime('today'));
            $em = $this->getDoctrine()->getManager();

            $em->persist($dane);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('failure', 'Dziękujemy! Miłego oglądania!');




            return $this->redirectToRoute('oferta');
        }


        //$em = $this->getDoctrine()->getManager();
        //$query = $em->createQuery(
        //    'SELECT f
        //         FROM WsbPozBundle:Filmy f
        //          WHERE f.idFilmu = :id_filmu'
        //    )
        //    ->setParameter('id_filmu', $id_filmu);

        //$kopia = $query->getResult();

        $film = $this->getDoctrine()
            ->getRepository('WsbPozBundle:Filmy')
            ->find($id_filmu);

        exit(\Doctrine\Common\Util\Debug::dump($kopie));
        return array('film'=> $film, 'id_usera'=> $app_user_id);
    }
    /**
     * @Route("/moje_wypozycz", name="moje_wypozycz")
     * @Template("WsbPozBundle:Default:moje_wypozycz.html.twig")
     */
    public function moje_wypozyczAction(Request $request) {

        if(!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        } else {
            $user = $this->getUser();
        }

        $app_user_id = $user->getId();

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT w, k, f
                 FROM WsbPozBundle:Wypozyczenia w
                  JOIN w.kopieKopii k
                  JOIN k.idFilmu f
                  WHERE w.appUsers = :user_id
                  '
        )
            ->setParameter('user_id', $app_user_id);
        $filmy = $query->getResult();

        return array('filmy' => $filmy);
        //exit(\Doctrine\Common\Util\Debug::dump($filmy));


    }
}
