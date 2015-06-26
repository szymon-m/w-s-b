<?php

namespace WsbPozBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wypozyczenia
 *
 * @ORM\Table(name="wypozyczenia", uniqueConstraints={@ORM\UniqueConstraint(name="unique_id_wypozyczenia", columns={"id_wypozyczenia"})}, indexes={@ORM\Index(name="fk_app_users_has_kopie_kopie1_idx", columns={"kopie_id_kopii"}), @ORM\Index(name="fk_app_users_has_kopie_app_users1_idx", columns={"app_users_id"})})
 * @ORM\Entity
 */
class Wypozyczenia
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_wypozyczenia", type="date", nullable=false)
     */
    private $dataWypozyczenia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_zwrotu", type="date", nullable=true)
     */
    private $dataZwrotu;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_wypozyczenia", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idWypozyczenia;

    /**
     * @var \WsbPozBundle\Entity\Kopie
     *
     * @ORM\ManyToOne(targetEntity="WsbPozBundle\Entity\Kopie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="kopie_id_kopii", referencedColumnName="id_kopii")
     * })
     */
    private $kopieKopii;

    /**
     * @var \WsbPozBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="WsbPozBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="app_users_id", referencedColumnName="id")
     * })
     */
    private $appUsers;



    /**
     * Set dataWypozyczenia
     *
     * @param \DateTime $dataWypozyczenia
     * @return Wypozyczenia
     */
    public function setDataWypozyczenia($dataWypozyczenia)
    {
        $this->dataWypozyczenia = $dataWypozyczenia;

        return $this;
    }

    /**
     * Get dataWypozyczenia
     *
     * @return \DateTime 
     */
    public function getDataWypozyczenia()
    {
        return $this->dataWypozyczenia;
    }

    /**
     * Set dataZwrotu
     *
     * @param \DateTime $dataZwrotu
     * @return Wypozyczenia
     */
    public function setDataZwrotu($dataZwrotu)
    {
        $this->dataZwrotu = $dataZwrotu;

        return $this;
    }

    /**
     * Get dataZwrotu
     *
     * @return \DateTime 
     */
    public function getDataZwrotu()
    {
        return $this->dataZwrotu;
    }

    /**
     * Get idWypozyczenia
     *
     * @return integer 
     */
    public function getIdWypozyczenia()
    {
        return $this->idWypozyczenia;
    }

    /**
     * Set kopieKopii
     *
     * @param \WsbPozBundle\Entity\Kopie $kopieKopii
     * @return Wypozyczenia
     */
    public function setKopieKopii(\WsbPozBundle\Entity\Kopie $kopieKopii = null)
    {
        $this->kopieKopii = $kopieKopii;

        return $this;
    }

    /**
     * Get kopieKopii
     *
     * @return \WsbPozBundle\Entity\Kopie 
     */
    public function getKopieKopii()
    {
        return $this->kopieKopii;
    }

    /**
     * Set appUsers
     *
     * @param \WsbPozBundle\Entity\User $appUsers
     * @return Wypozyczenia
     */
    public function setAppUsers(\WsbPozBundle\Entity\User $appUsers = null)
    {
        $this->appUsers = $appUsers;

        return $this;
    }

    /**
     * Get appUsers
     *
     * @return \WsbPozBundle\Entity\User
     */
    public function getAppUsers()
    {
        return $this->appUsers;
    }
}
