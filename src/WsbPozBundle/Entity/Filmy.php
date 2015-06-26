<?php

namespace WsbPozBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Filmy
 *
 * @ORM\Table(name="filmy")
 * @ORM\Entity
 */
class Filmy
{
    /**
     * @var string
     *
     * @ORM\Column(name="tytul", type="string", length=40, nullable=true)
     */
    private $tytul;



    /**
     * @ORM\OneToMany(targetEntity="WsbPozBundle\Entity\Kopie", mappedBy="id_filmu")
     **/
    private $kopie;

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getKopie()
    {
        return $this->idFilmu;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function setKopie($kopie)
    {
        $this->kopie = $kopie;
    }


    /**
     * @var integer
     *
     * @ORM\Column(name="rok_produkcji", type="integer", nullable=true)
     */
    private $rokProdukcji;

    /**
     * @var float
     *
     * @ORM\Column(name="cena", type="float", precision=10, scale=0, nullable=true)
     */
    private $cena;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_filmu", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     */
    private $idFilmu;

    public function IdFilmu() {

        return $this->getIdFilmu();
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="WsbPozBundle\Entity\Aktorzy", mappedBy="filmyFilmu")
     */
    private $aktorzyAktora;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->aktorzyAktora = new \Doctrine\Common\Collections\ArrayCollection();
        $this->films = new \Doctrine\Common\Collections\ArrayCollection();
        $this->kopie = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {

        return $this->getTytul();
    }

    private $films;

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getFilms()
    {
        return $this->films;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $films
     */
    public function setFilms($films)
    {
        $this->films = $films;
    }

    /**
     * Set tytul
     *
     * @param string $tytul
     * @return Filmy
     */
    public function setTytul($tytul)
    {
        $this->tytul = $tytul;

        return $this;
    }

    /**
     * Get tytul
     *
     * @return string 
     */
    public function getTytul()
    {
        return $this->tytul;
    }

    /**
     * Set rokProdukcji
     *
     * @param integer $rokProdukcji
     * @return Filmy
     */
    public function setRokProdukcji($rokProdukcji)
    {
        $this->rokProdukcji = $rokProdukcji;

        return $this;
    }

    /**
     * Get rokProdukcji
     *
     * @return integer 
     */
    public function getRokProdukcji()
    {
        return $this->rokProdukcji;
    }

    /**
     * Set cena
     *
     * @param float $cena
     * @return Filmy
     */
    public function setCena($cena)
    {
        $this->cena = $cena;

        return $this;
    }

    /**
     * Get cena
     *
     * @return float 
     */
    public function getCena()
    {
        return $this->cena;
    }

    /**
     * Get idFilmu
     *
     * @return integer 
     */
    public function getIdFilmu()
    {
        return $this->idFilmu;
    }

    /**
     * Add aktorzyAktora
     *
     * @param \WsbPozBundle\Entity\Aktorzy $aktorzyAktora
     * @return Filmy
     */
    public function addAktorzyAktora(\WsbPozBundle\Entity\Aktorzy $aktorzyAktora)
    {
        $this->aktorzyAktora[] = $aktorzyAktora;

        return $this;
    }

    /**
     * Remove aktorzyAktora
     *
     * @param \WsbPozBundle\Entity\Aktorzy $aktorzyAktora
     */
    public function removeAktorzyAktora(\WsbPozBundle\Entity\Aktorzy $aktorzyAktora)
    {
        $this->aktorzyAktora->removeElement($aktorzyAktora);
    }

    /**
     * Get aktorzyAktora
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAktorzyAktora()
    {
        return $this->aktorzyAktora;
    }
}
