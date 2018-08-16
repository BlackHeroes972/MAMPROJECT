<?php
/**
 * Created by PhpStorm.
 * User: BlackHeroes972
 * Date: 08/08/2018
 * Time: 15:23
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Enfant")
 */
class Enfant
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $prenom;


    /**
     * @ORM\Column(type="string", length=125, nullable=true)
     */
    private $sexe;


    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_naissance;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_inscription;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AssistanteMaternelle", inversedBy="enfants")
     */
    private $assistanteMaternelle;

    /**
     * @param AppBundle\Entity\AssistanteMaternelle $assistanteMaternelle
     * @return $this
     */
    public function setAssistanteMaternelle(AppBundle\Entity\AssistanteMaternelle $assistanteMaternelle)
    {
        $this->assistanteMaternelle = $assistanteMaternelle;
        return $this;
    }

    /**
     * @return AppBundle\Entity\AssistanteMaternelle
     */
    public function getAssistanteMaternelle()
    {
        return $this->assistanteMaternelle;
    }

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Enfant
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Enfant
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return Enfant
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Enfant
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->date_naissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->date_naissance;
    }

    /**
     * Set dateInscription
     *
     * @param \DateTime $dateInscription
     *
     * @return Enfant
     */
    public function setDateInscription($dateInscription)
    {
        $this->date_inscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription
     *
     * @return \DateTime
     */
    public function getDateInscription()
    {
        return $this->date_inscription;
    }
}
