<?php

namespace WsbPozBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WsbPozBundle\Entity\Aktorzy;
use WsbPozBundle\Entity\Filmy;
use WsbPozBundle\Entity\Filmy_has_Aktorzy;
use WsbPozBundle\Entity\Kopie;
use WsbPozBundle\Entity\WybranyFilm;
use WsbPozBundle\Form\Type\DodajAktoraType;
use WsbPozBundle\Form\Type\DodajFilmType;
use WsbPozBundle\Form\Type\DodajAktoraDoFilmu;
use Symfony\Component\Form\SubmitButton;
use WsbPozBundle\Form\Type\KopieType;

class AdminController extends Controller
{
    /**
     * @Route("/admin/nowy_film", name="nowy_film")
     * @Template("WsbPozBundle:Admin:nowy_film.html.twig")
     */
    public function nowy_filmAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Nie masz uprawnień!');
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
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Nie masz uprawnień!');
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
     * @Route("/admin/usun_film")
     * @Template()
     */
    public function usun_filmAction()
    {
        return array(// ...
        );
    }

    /**
     * @Route("/admin/zmien_obsade", name="zmien_obsade")
     * @Template("WsbPozBundle:Admin:zmien_obsade.html.twig")
     */
    public function zmien_obsadeAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Nie masz uprawnień!');
        $wybrany_film = new Filmy_has_Aktorzy();
        $form = $this->createForm(new DodajAktoraDoFilmu(), $wybrany_film);

        $form->handleRequest($request);
        //$form->createView();
        $wybrany_film = $form->getData();

        if ($form->isValid()) {


            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                'SELECT f
                  FROM WsbPozBundle:Filmy_has_Aktorzy f
                  WHERE f.filmyIdFilmu = :id_filmu
                  AND f.aktorzyIdAktora = :id_aktora'
            )
                ->setParameters(array(
                    'id_filmu' => $wybrany_film->getFilmyIdFilmu()->getIdFilmu(),
                    'id_aktora' => $wybrany_film->getAktorzyIdAktora()->getIdAktora(),
                ));

            if ($query->getResult() == null) {

                $dane = new Filmy_has_Aktorzy();
                $dane->setAktorzyIdAktora($wybrany_film->getAktorzyIdAktora()->getIdAktora());
                $dane->setFilmyIdFilmu($wybrany_film->getFilmyIdFilmu()->getIdFilmu());
                $em = $this->getDoctrine()->getManager();

                $em->persist($dane);
                $em->flush();
            } else {

                $request->getSession()
                    ->getFlashBag()
                    ->add('failure', 'Nie możesz dodać takiego aktora!');

                return $this->redirectToRoute('dodaj_aktora');
            }


            //exit(\Doctrine\Common\Util\Debug::dump($dane));

        }

        return array('film' => $wybrany_film);
        /*if($form->isValid()) {

            //return array('filmy' => $filmy);

            exit(\Doctrine\Common\Util\Debug::dump($filmy));
        }*/


        /*

        $filmy = $form->getData();



        if ($form->isValid()) {
            // ... perform some action, such as saving the task to the database
            $nextAction = $form->get('wybierz')->isClicked()
                ? 'dodaj_film'
                : 'hello';

            return $this->redirectToRoute($nextAction);
        }*/
    }

    /**
     * @Route("/admin/obsada", name="obsada")
     * @Template("WsbPozBundle:Admin:obsada.html.twig")
     */
    public function obsadaAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Nie masz uprawnień!');
        $film = new Filmy_has_Aktorzy();
        $form = $this->createForm(new DodajAktoraDoFilmu(), $film);
        //$form = $this->createForm(new DodajAktoraDoFilmu(), $film, array(
        //    'action' => $this->generateUrl('zmien_obsade'),
        //    'method' => 'POST',
        //));
        //$form->createView();
        //return array('form' => $form->createView() );

        //$form->handleRequest($request);
        //if($form->isSubmitted()) {
        //    exit(\Doctrine\Common\Util\Debug::dump($film));
        //}
        $aktorzy = array();
        //return array('form' => $form->createView(), 'aktorzy' => $aktorzy);
        return array('form' => $form->createView());

        /*
        if($form->isValid()) {


        $nextAction = $form->get('aktora_do_filmu_wybierz')->isClicked()
                ? 'dodaj_film'
                : 'hello';

            return $this->redirectToRoute($nextAction);
        }*/

        /*
         $film = new Filmy();
         $form = $this->createFormBuilder($film)
              ->add('tytul','entity', array(
                  'class' => 'WsbPozBundle:Filmy',
                  'property' => 'tytul',

              ))
              ->add('Wybierz','submit')
              ->getForm();

         $form->createView();

         if ($form->isValid()) {
             // ... perform some action, such as saving the task to the database

             if($form->get('Wybierz')->isClicked()) {
                 return $this->redirectToRoute('dodaj_film');
             } else {
                 return $this->redirectToRoute('hello');
             }



         }*/

    }

    /**
     * @Route("/admin/dodaj_aktora", name="dodaj_aktora")
     * @Template("WsbPozBundle:Admin:dodaj_aktora.html.twig")
     */
    public function dodaj_aktoraAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Nie masz uprawnień!');
        $aktor = new Aktorzy();
        $form = $this->createForm(new DodajAktoraType(), $aktor, array(
            'action' => $this->generateUrl('nowy_aktor'),
        ));

        return array('form' => $form->createView());

    }

    /**
     * @Route("/admin/nowy_aktor", name="nowy_aktor")
     * @Template("WsbPozBundle:Admin:nowy_aktor.html.twig")
     */
    public function nowy_aktorAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Nie masz uprawnień!');
        $aktor = new Aktorzy();
        $form = $this->createForm(new DodajAktoraType(), $aktor);

        $form->handleRequest($request);
        $form->createView();
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $actor = $form->getData();
            $em->persist($actor);
            $em->flush();

            return array('actor' => $actor);

        } else {

            $request->getSession()
                ->getFlashBag()
                ->add('failure', 'Nie możesz dodać takiego aktora!');

            return $this->redirectToRoute('dodaj_aktora');
        }

    }

    /**
     *
     * @Route("/admin/aktorzy/", name="admin/aktorzy")
     *
     *
     */
    public function aktorzyAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Nie masz uprawnień!');
        $request = Request::createFromGlobals();

        $filmyIdFilmu = $request->request->get('filmyIdFilmu');

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(      // działa również na dwóch zmiennych
            'SELECT f, a
              FROM WsbPozBundle:Aktorzy f
              JOIN f.filmyFilmu a
              WHERE a.idFilmu = :id_filmu
              ORDER BY f.idAktora ASC'
        )->setParameter('id_filmu', $filmyIdFilmu);

        /*$query = $em->createQuery(
            'SELECT a, f
              FROM WsbPozBundle:Aktorzy a
              JOIN a.filmyFilmu f
              ORDER BY a.idAktora ASC'
        );*/


        $dane = $query->getResult();
        //exit(\Doctrine\Common\Util\Debug::dump($dane));
        $aktorzy = '<div id="aktorzy"><table width=80%><tr><th>Imię i nazwisko</th><th>Usuń</th></tr>';
        foreach ($dane as $aktor) {

            $aktorzy .= '<tr><td>' . $aktor->getidAktora() . '  ' . $aktor->getimie() . '  ' . $aktor->getnazwisko() . '</td>
            <td><a href=' . $this->generateUrl('usun_aktora_z_obsady', array('id_aktora' => $aktor->getidAktora(), 'id_filmu' => $filmyIdFilmu)) . '>Usuń</a></td></tr>';
        }
        $aktorzy .= "</table></div>";

        $return = array("responseCode" => 200, "aktorzy" => $aktorzy);

        $return = json_encode($return);//jscon encode the array
        return new Response($aktorzy, 200, array('Content-Type' => 'text/html'));


    }

    /**
     *
     * @Route("/admin/aktorzy_nie_wystepujacy/", name="admin/aktorzy_nie_wystepujacy")
     *
     *
     */
    public function aktorzy_nie_wystepujacyAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Nie masz uprawnień!');
        $request = Request::createFromGlobals();

        $filmyIdFilmu = $request->request->get('filmyIdFilmu');

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(      // działa również na dwóch zmiennych
            'SELECT a
              FROM WsbPozBundle:Aktorzy a
              WHERE a.idAktora NOT IN
                (SELECT DISTINCT f
                  FROM WsbPozBundle:Aktorzy f
                  JOIN f.filmyFilmu l
                  WHERE l.idFilmu = :id_filmu
                 )
              ORDER BY a.idAktora ASC'
        )->setParameter('id_filmu', $filmyIdFilmu);

        /*$query = $em->createQuery(
            'SELECT a, f
              FROM WsbPozBundle:Aktorzy a
              JOIN a.filmyFilmu f
              ORDER BY a.idAktora ASC'
        );*/


        $dane = $query->getResult();
        //exit(\Doctrine\Common\Util\Debug::dump($dane));
        $aktorzy = '<div id="aktorzy_nie"><table width=80%><tr><th>Imię i nazwisko</th><th>Dodaj</th></tr>';
        foreach ($dane as $aktor) {

            $aktorzy .= '<tr><td>' . $aktor->getidAktora() . '  ' . $aktor->getimie() . '  ' . $aktor->getnazwisko() . '</td>
            <td><a href=' . $this->generateUrl('dodaj_aktora_do_obsady', array('id_aktora' => $aktor->getidAktora(), 'id_filmu' => $filmyIdFilmu)) . '>Dodaj</a></td></tr>';
        }
        $aktorzy .= "</table></div>";

        $return = array("responseCode" => 200, "aktorzy" => $aktorzy);

        $return = json_encode($return);//jscon encode the array
        return new Response($aktorzy, 200, array('Content-Type' => 'text/html'));


    }

    /**
     * @Route("/admin/usun_aktora_z_obsady", name="usun_aktora_z_obsady")
     * @Template()
     */
    public function usun_aktora_z_obsadyAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Nie masz uprawnień!');
        //$request = Request::createFromGlobals();
        $id_aktora = $request->query->get('id_aktora');
        $id_filmu = $request->query->get('id_filmu');


        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT f
                  FROM WsbPozBundle:Filmy_has_Aktorzy f
                  WHERE f.filmyIdFilmu = :id_filmu
                  AND f.aktorzyIdAktora = :id_aktora'
        )
            ->setParameters(array(
                'id_filmu' => $id_filmu,
                'id_aktora' => $id_aktora,
            ));

        if ($query->getResult() == null) {

            $request->getSession()
                ->getFlashBag()
                ->add('failure', 'Nie możesz dodać takiego aktora!');

            return $this->redirectToRoute('obsada');

        } else {

            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                'DELETE WsbPozBundle:Filmy_has_Aktorzy f
                  WHERE f.filmyIdFilmu = :id_filmu
                  AND f.aktorzyIdAktora = :id_aktora'
            )
                ->setParameters(array(
                    'id_filmu' => $id_filmu,
                    'id_aktora' => $id_aktora,
                ));
            $query->getResult();

            $request->getSession()
                ->getFlashBag()
                ->add('failure', 'Usunięto aktora!');

            return $this->redirectToRoute('obsada');
        }
    }

    /**
     * @Route("/admin/dodaj_aktora_do_obsady", name="dodaj_aktora_do_obsady")
     * @Template()
     */

    public function dodaj_aktora_do_obsadyAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Nie masz uprawnień!');
        //$request = Request::createFromGlobals();
        $id_aktora = $request->query->get('id_aktora');
        $id_filmu = $request->query->get('id_filmu');


        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT f
                  FROM WsbPozBundle:Filmy_has_Aktorzy f
                  WHERE f.filmyIdFilmu = :id_filmu
                  AND f.aktorzyIdAktora = :id_aktora'
        )
            ->setParameters(array(
                'id_filmu' => $id_filmu,
                'id_aktora' => $id_aktora,
            ));

        if ($query->getResult() == null) {

            $dane = new Filmy_has_Aktorzy();
            $dane->setAktorzyIdAktora($id_aktora);
            $dane->setFilmyIdFilmu($id_filmu);
            $em = $this->getDoctrine()->getManager();

            $em->persist($dane);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('failure', 'Dodano aktora! ');

            return $this->redirectToRoute('obsada');
        } else {

            $request->getSession()
                ->getFlashBag()
                ->add('failure', 'Nie możesz dodać takiego aktora!');

            return $this->redirectToRoute('obsada');
        }
    }

    /**
     * @Route("/admin/kopie", name="kopie")
     * @Template("WsbPozBundle:Admin:kopie.html.twig")
     */
    public function kopieAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Nie masz uprawnień!');
        $kopie = new Filmy();
        $form = $this->createForm(new KopieType(), $kopie);
        //$form = $this->createForm(new DodajAktoraDoFilmu(), $film, array(
        //    'action' => $this->generateUrl('zmien_obsade'),
        //    'method' => 'POST',
        //));
        //$form->createView();
        //return array('form' => $form->createView() );

        //$form->handleRequest($request);
        //if($form->isSubmitted()) {
        //    exit(\Doctrine\Common\Util\Debug::dump($film));
        //}
        //$aktorzy = array();
        //return array('form' => $form->createView(), 'aktorzy' => $aktorzy);
        return array('form' => $form->createView());


    }
    /**
     * @Route("/admin/pobierz_kopie", name="pobierz_kopie")
     * @Template("WsbPozBundle:Admin:kopie.html.twig")
     */
    public function pobierzkopieAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Nie masz uprawnień!');
        $request = Request::createFromGlobals();

        $filmyIdFilmu = $request->request->get('idFilmu');

        //$filmyIdFilmu = 1;
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(      // działa również na dwóch zmiennych
            'SELECT k
              FROM WsbPozBundle:Kopie k
              JOIN k.idFilmu f
              WHERE k.idFilmu = :id_filmu'
        )->setParameter('id_filmu', $filmyIdFilmu);

        $dane = $query->getResult();
        //exit(\Doctrine\Common\Util\Debug::dump($filmy));



        //exit(\Doctrine\Common\Util\Debug::dump($dane));
        $kopie = '<div id="kopie2"><table width=80%><tr><th>Numer kopii</th><th>Czy dostępna?</th><th>Usuń</th></tr>';
        foreach ($dane as $film) {

            $kopie .= '<tr><td>' . $film->getidKopii() . '</td><td>';

            if($film->getCzyDostepna()=='0') {
                $dostepna = "wypożyczona";
            } elseif ($film->getCzyDostepna()=='1') {
                $dostepna = "dostępna";
            };
            $kopie .= $dostepna.'</td>';
            $url = $this->generateUrl('usun_kopie',array('id_kopii' => $film->getidKopii() ) );
            if($film->getCzyDostepna()=='1') {
                $kopie .='<td><a href=' . $url . '>Usuń kopię</a></td></tr>';
            } elseif ($film->getCzyDostepna()=='0') {

                $kopie .='<td>nie można usunąć</td></tr>';
        }


        }
        $kopie .= "</table>";

        $url_2 = $this->generateUrl('dodaj_kopie', array('id_filmu' => $filmyIdFilmu ));

        $kopie .='</br></br><a href='. $url_2 .'>Dodaj jedną kopię</a></div>';

        $return = array("responseCode" => 200, "kopie" => $kopie);

        $return = json_encode($return);//jscon encode the array
        return new Response($kopie, 200, array('Content-Type' => 'text/html'));
    }
    /**
     * @Route("/admin/usun_kopie", name="usun_kopie")
     *
     */
    public function usunkopieAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Nie masz uprawnień!');
        //$request = Request::createFromGlobals();

        $id_kopii = (int)$request->query->get('id_kopii');


        //exit(\Doctrine\Common\Util\Debug::dump($id_kopii));

        $em = $this->getDoctrine()->getManager();
        $kopia = $em->getRepository('WsbPozBundle:Kopie')->find($id_kopii);

        if (!$kopia) {
            throw $this->createNotFoundException(
                'No product found for id '.$id_kopii
            );
        }

        $em->remove($kopia);
        $em->flush();

        $request->getSession()
            ->getFlashBag()
            ->add('failure', 'Usunięto kopię !');

        return $this->redirectToRoute('kopie');

    }
    /**
     * @Route("/admin/dodaj_kopie", name="dodaj_kopie")
     *
     */
    public function dodajkopieAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Nie masz uprawnień!');
        //$request = Request::createFromGlobals();

        $id_filmu = (int)$request->query->get('id_filmu');


        //exit(\Doctrine\Common\Util\Debug::dump($id_kopii));
        $film = $this->getDoctrine()
            ->getRepository('WsbPozBundle:Filmy')
            ->find($id_filmu);



        $em = $this->getDoctrine()->getManager();
        $kopia_nowa = new Kopie();
        $kopia_nowa->setIdFilmu($film);
        $kopia_nowa->setCzyDostepna(1);
        $em->persist($kopia_nowa);
        $em->flush();


        $request->getSession()
            ->getFlashBag()
            ->add('failure', 'Dodano kopię !');

        return $this->redirectToRoute('kopie');
    }
}
