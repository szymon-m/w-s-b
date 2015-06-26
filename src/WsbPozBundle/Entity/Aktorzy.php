<?php

namespace WsbPozBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Aktorzy
 *
 * @ORM\Table(name="aktorzy")
 * @ORM\Entity
 */
class Aktorzy
{
    /**
     * @var string
     *
     * @ORM\Column(name="imie", type="string", length=20, nullable=true)
     */
    private $imie;

    /**
     * @var string
     *
     * @ORM\Column(name="nazwisko", type="string", length=20, nullable=true)
     */
    private $nazwisko;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_aktora", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAktora;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="WsbPozBundle\Entity\Filmy", mappedBy="aktorzyAktora")
     */
    private $filmyFilmu;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->filmyFilmu = new \Doctrine\Common\Collections\ArrayCollection();
        $this->actors = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {

        return $this->getNazwisko();
    }
    private $actors;

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $actors
     */
    public function setActors($actors)
    {
        $this->actors = $actors;
    }


    /**
     * Set imie
     *
     * @param string $imie
     * @return Aktorzy
     */
    public function setImie($imie)
    {
        $this->imie = $imie;

        return $this;
    }

    /**
     * Get imie
     *
     * @return string 
     */
    public function getImie()
    {
        return $this->imie;
    }

    /**
     * Set nazwisko
     *
     * @param string $nazwisko
     * @return Aktorzy
     */
    public function setNazwisko($nazwisko)
    {
        $this->nazwisko = $nazwisko;

        return $this;
    }

    /**
     * Get nazwisko
     *
     * @return string 
     */
    public function getNazwisko()
    {
        return $this->nazwisko;
    }

    /**
     * Get idAktora
     *
     * @return integer 
     */
    public function getIdAktora()
    {
        return $this->idAktora;
    }

    /**
     * Add filmyFilmu
     *
     * @param \WsbPozBundle\Entity\Filmy $filmyFilmu
     * @return Aktorzy
     */
    public function addFilmyFilmu(\WsbPozBundle\Entity\Filmy $filmyFilmu)
    {
        $this->filmyFilmu[] = $filmyFilmu;

        return $this;
    }

    /**
     * Remove filmyFilmu
     *
     * @param \WsbPozBundle\Entity\Filmy $filmyFilmu
     */
    public function removeFilmyFilmu(\WsbPozBundle\Entity\Filmy $filmyFilmu)
    {
        $this->filmyFilmu->removeElement($filmyFilmu);
    }

    /**
     * Get filmyFilmu
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFilmyFilmu()
    {
        return $this->filmyFilmu;
    }
}
