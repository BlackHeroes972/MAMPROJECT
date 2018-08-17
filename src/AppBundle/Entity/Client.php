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
 * @ORM\Table(name="client")
 */
class Client
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
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $profession;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $tel;

    /**
     * @var User
     * @ORM\OneToOne(targetEntity="User", mappedBy="client")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="AssistanteMaternelle", inversedBy="clients")
     */
    private $assistanteMaternelle;

    /**
     * @var ArrayCollection|Enfant[]
     * @ORM\OneToMany(targetEntity="Enfant", mappedBy="parent", cascade={"persist"})
     */
    private $enfants;

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
        if (!$this->enfants->contains($enfant)) {
            $this->enfants[] = $enfant;
            $enfant->setParent($this);
        }
        return $this;
    }

    /**
     * @param Enfant $enfant
     * @return $this
     */
    public function removeEnfant(Enfant $enfant)
    {
        if ($this->enfants->contains($enfant)) {
            $this->enfants->removeElement($enfant);
            $enfant->setParent(null);
        }
        return $this;
    }


    /**
     * @param AssistanteMaternelle $assistanteMaternelle
     * @return $this
     */
    public function setAssistanteMaternelle(AssistanteMaternelle $assistanteMaternelle)
    {
        $this->assistanteMaternelle = $assistanteMaternelle;
        return $this;
    }

    /**
     * @return AssistanteMaternelle
     */
    public function getAssistanteMaternelle()
    {
        return $this->assistanteMaternelle;
    }


    // du coup je suis entrian de reflechir l'assistante maternelle je suis meme pas sur qu'elle soit relié
    // a enfant elle est relié a parent qui lui est relié a enfant, mais l'assistante maternelle elle est juste relié a client
    // jetaos face a ce dilemne ce matin .... lassismatt est relier a lenfant par le parent
    // donc assmatt relier a parent ki possede enfant
    // ouai c plus logique que d ecréer des potentiel enfant sans parents et de joindre les parents ensuite

    // bon deja client est pas relié a enfant donc il peut pas avoir d'enfant
    //dc normalement fo faire un onetoone avec private enfant
    // ouai je ferai un oneToMany parso parce que tu peux avoir plusieurs enfant :p mais oneToOne

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Client
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
     * @return Client
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
     * Set profession
     *
     * @param string $profession
     *
     * @return Client
     */
    public function setProfession($profession)
    {
        $this->profession = $profession;

        return $this;
    }

    /**
     * Get profession
     *
     * @return string
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Client
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
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Client
     */
    public function setUser(User $user): Client
    {
        $this->user = $user;
        return $this;
    }


}
