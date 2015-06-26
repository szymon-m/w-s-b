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
     */
    private $idFilmu;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="WsbPozBundle\Entity\Aktorzy", inversedBy="filmyFilmu")
     * @ORM\JoinTable(name="filmy_has_aktorzy",
     *   joinColumns={
     *     @ORM\JoinColumn(name="filmy_id_filmu", referencedColumnName="id_filmu")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="aktorzy_id_aktora", referencedColumnName="id_aktora")
     *   }
     * )
     */
    private $aktorzyAktora;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->aktorzyAktora = new \Doctrine\Common\Collections\ArrayCollection();
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
