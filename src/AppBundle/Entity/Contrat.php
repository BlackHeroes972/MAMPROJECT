<?php
/**
 * Created by PhpStorm.
 * User: BlackHeroes972
 * Date: 08/08/2018
 * Time: 15:18
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="Contrat")
 */
class Contrat
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", length=2 , nullable=true)
     */
    private $nb_enfant;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_debut;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_fin;

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
     * Set nbEnfant
     *
     * @param integer $nbEnfant
     *
     * @return Contrat
     */
    public function setNbEnfant($nbEnfant)
    {
        $this->nb_enfant = $nbEnfant;

        return $this;
    }

    /**
     * Get nbEnfant
     *
     * @return integer
     */
    public function getNbEnfant()
    {
        return $this->nb_enfant;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Contrat
     */
    public function setDateDebut($dateDebut)
    {
        $this->date_debut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->date_debut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Contrat
     */
    public function setDateFin($dateFin)
    {
        $this->date_fin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->date_fin;
    }
}
