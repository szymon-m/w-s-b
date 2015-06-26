<?php

namespace WsbPozBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kopie
 *
 * @ORM\Table(name="kopie", indexes={@ORM\Index(name="fk_kopie_filmy1_idx", columns={"id_filmu"})})
 * @ORM\Entity
 */
class Kopie
{
    /**
     * @var string
     *
     * @ORM\Column(name="czy_dostepna", type="string", length=1, nullable=true)
     */
    private $czyDostepna;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_kopii", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idKopii;

    /**
     * @var \WsbPozBundle\Entity\Filmy
     *
     * @ORM\ManyToOne(targetEntity="WsbPozBundle\Entity\Filmy")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_filmu", referencedColumnName="id_filmu")
     * })
     */
    private $idFilmu;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="WsbPozBundle\Entity\User", mappedBy="kopieKopii")
     */
    private $appUsers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->appUsers = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set czyDostepna
     *
     * @param string $czyDostepna
     * @return Kopie
     */
    public function setCzyDostepna($czyDostepna)
    {
        $this->czyDostepna = $czyDostepna;

        return $this;
    }

    /**
     * Get czyDostepna
     *
     * @return string 
     */
    public function getCzyDostepna()
    {
        return $this->czyDostepna;
    }

    /**
     * Get idKopii
     *
     * @return integer 
     */
    public function getIdKopii()
    {
        return $this->idKopii;
    }

    /**
     * Set idFilmu
     *
     * @param \WsbPozBundle\Entity\Filmy $idFilmu
     * @return Kopie
     */
    public function setIdFilmu(\WsbPozBundle\Entity\Filmy $idFilmu = null)
    {
        $this->idFilmu = $idFilmu;

        return $this;
    }

    /**
     * Get idFilmu
     *
     * @return \WsbPozBundle\Entity\Filmy 
     */
    public function getIdFilmu()
    {
        return $this->idFilmu;
    }

    /**
     * Add appUsers
     *
     * @param \WsbPozBundle\Entity\User $appUsers
     * @return Kopie
     */
    public function addAppUser(\WsbPozBundle\Entity\User $appUsers)
    {
        $this->appUsers[] = $appUsers;

        return $this;
    }

    /**
     * Remove appUsers
     *
     * @param \WsbPozBundle\Entity\User $appUsers
     */
    public function removeAppUser(\WsbPozBundle\Entity\User $appUsers)
    {
        $this->appUsers->removeElement($appUsers);
    }

    /**
     * Get appUsers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAppUsers()
    {
        return $this->appUsers;
    }
}
