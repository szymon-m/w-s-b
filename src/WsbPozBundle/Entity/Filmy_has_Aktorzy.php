<?php

namespace WsbPozBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\BrowserKit\Request;

/**
 * Filmy_has_Aktorzy
 *
 * @ORM\Table(name="filmy_has_aktorzy")
 * @ORM\Entity
 */
class Filmy_has_Aktorzy
{
    /*
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    //private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="filmy_id_filmu", type="integer")
     */
    private $filmyIdFilmu;

    /**
     * @var integer
     *
     * @ORM\Column(name="aktorzy_id_aktora", type="integer")
     */
    private $aktorzyIdAktora;


    /*
     * Get id
     *
     * @return integer 

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set filmyIdFilmu
     *
     * @param integer $filmyIdFilmu
     * @return Filmy_has_Aktorzy
     */
    public function setFilmyIdFilmu($filmyIdFilmu)
    {
        $this->filmyIdFilmu = $filmyIdFilmu;

        return $this;
    }

    /**
     * Get filmyIdFilmu
     *
     * @return integer
     */
    public function getFilmyIdFilmu()
    {
        return $this->filmyIdFilmu;
    }

    /**
     * Set aktorzyIdAktora
     *
     * @param integer $aktorzyIdAktora
     * @return Filmy_has_Aktorzy
     */
    public function setAktorzyIdAktora($aktorzyIdAktora)
    {
        $this->aktorzyIdAktora = $aktorzyIdAktora;

        return $this;
    }

    /**
     * Get aktorzyIdAktora
     *
     * @return integer
     */
    public function getAktorzyIdAktora()
    {
        return $this->aktorzyIdAktora;
    }

    public function addNewFilmyHasAktorzy(Filmy_has_Aktorzy $form, Request $request)
    {

        if ($this->filmyIdFilmu == $form->getFilmyIdFilmu() || $this->aktorzyIdAktora == $form->getAktorzyIdAktora()) {

            $request->getSession()
                ->getFlashBag()
                ->add('failure', 'Nie możesz dodać takiego aktora!');

            return $this->redirectToRoute('dodaj_film');
        };// else {

        //$dane = null;
        //$dane->setAktorzyIdAktora($form->getFilmyIdFilmu()->getIdFilmu());
        //$dane->setFilmyIdFilmu($form->getAktorzyIdAktora()->getIdAktora());

        //return $dane;
        //}
    }

};