<?php

namespace WsbPozBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kontakt
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Kontakt
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="tresc", type="string", length=255)
     */
    private $tresc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_wprowadzenia", type="date")
     */
    private $dataWprowadzenia;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Kontakt
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set tresc
     *
     * @param string $tresc
     * @return Kontakt
     */
    public function setTresc($tresc)
    {
        $this->tresc = $tresc;

        return $this;
    }

    /**
     * Get tresc
     *
     * @return string 
     */
    public function getTresc()
    {
        return $this->tresc;
    }

    /**
     * Set dataWprowadzenia
     *
     * @param \DateTime $dataWprowadzenia
     * @return Kontakt
     */
    public function setDataWprowadzenia($dataWprowadzenia)
    {
        $this->dataWprowadzenia = $dataWprowadzenia;

        return $this;
    }

    /**
     * Get dataWprowadzenia
     *
     * @return \DateTime 
     */
    public function getDataWprowadzenia()
    {
        return $this->dataWprowadzenia;
    }
}
