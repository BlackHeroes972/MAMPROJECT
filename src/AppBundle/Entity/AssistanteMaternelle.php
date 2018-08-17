<?php
/**
 * Created by PhpStorm.
 * User: BlackHeroes972
 * Date: 08/08/2018
 * Time: 14:41
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="AssistanteMaternelle")
 */
class AssistanteMaternelle
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $tel;

    /**
     * @ORM\Column(type="integer", length=2 , nullable=true)
     */
    private $nb_agrements;

    /**
     * @var ArrayCollection|Enfant[]
     * @ORM\OneToMany(targetEntity="Enfant", mappedBy="assistanteMaternelle", cascade={"persist"})
     */
    private $enfants;

    // a la construction de mon objet je dis que $this->enfants est un ArrayCollection
    public function __construct()
    {
        $this->enfants = new ArrayCollection();
    }

    /**
     * @return Enfant[]|ArrayCollection
     */
    public function getEnfants()
    {
        return $this->enfants;
    }

    /**
     * @param Enfant $enfant
     * @return $this
     */
    public function addEnfant(Enfant $enfant)
    {
        // si le array enfants ne contient pas déjà cette enfant pour éviter d'ajouter 2 fois
        if (!$this->enfants->contains($enfant)) {
            //  j'ajoute enfants dans le [] enfant
            $this->enfants[] = $enfant;
            // et je set la relation opposé je dit que pour enfant l'assistante maternelle c'est $this
            // car l'assistante maternelle c'est l'objet en cours
            $enfant->setAssistanteMaternelle($this);
        }
        return $this;
    }

    /**
     * @param Enfant $enfant
     * @return $this
     */
    public function removeEnfant(Enfant $enfant)
    {
        // si mon array d'enfant contient l'enfant en question je le supprime pour eviter de supprimer
        // un truc qui existe pas pour pas avoir d'erreur
        if ($this->enfants->contains($enfant)) {
            // je remove l'enfants du aray
            $this->enfants->removeElement($enfant);
            // et je set la liaison opossé a null pour dire que cette enfant n'a pas d'assistante maternelle
            $enfant->setAssistanteMaternelle(null);
        }
        return $this;
    }

    // on remarque que j'utilise enfants [} comme un array spécial qui a des fonctions
    // genre removeElement ou contains, c'est parce que c'erst un super Array symfony
    // un arrayCollection qui est une class symfony donc je dois dire qu'au départ enfants est un arrayCollection
    // je peux fair eplein de truc avec Arraycollection qsuffit de mater la doc comme filter ou classer par ordre, compter, ect
    // maintenant je vérifie que ma jointure est bonne

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return AssistanteMaternelle
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
     * @return AssistanteMaternelle
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
     * Set tel
     *
     * @param string $tel
     *
     * @return AssistanteMaternelle
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set nbAgrements
     *
     * @param integer $nbAgrements
     *
     * @return AssistanteMaternelle
     */
    public function setNbAgrements($nbAgrements)
    {
        $this->nb_agrements = $nbAgrements;

        return $this;
    }

    /**
     * Get nbAgrements
     *
     * @return integer
     */
    public function getNbAgrements()
    {
        return $this->nb_agrements;
    }
}
