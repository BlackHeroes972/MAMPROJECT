<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    // oké la faudra rajouter une liaison OneToOne a Client et une autre a Assistante Maternelle
    // pour savoir si l'user et l'un ou l'autre et a la création du compte il faudra rajouter un ecoute sur l'event
    // registration pour créer un User avec les infos rentré dans user (dans le formulaire d'inscription) et
    // ajouter le Client à l'user, pour les 3 assistantes maternelle suffira de les créer directe en base de donnée
    // et les rélies a la mano en bdd ou a faire une création de fixture (en gros une fonction dans un controller,
    // qui te créer tes 3 assistante maternelle.


    // Un truc sympa que tu peux utilisé dans phpstorm et qui peux te gagner du temps pour faire les jointures
    // vu que tu en a que 4 type les OneToOne  OneToMany  ManytoOne ManyToMany
    // c'est les lives template, tu créer une fois ta jointure et tu remplace les differents truc qui change par des variables
    // je t'en montre une pour que tu piges, je vais copier un de mes lives templates perso

   // ca lag a mort je sais p as si c toi pou moi
   // ca doit etre moi comme ça vient e demarrer
    //  ok je vais essayer d'ajouter le reste des live template

    // ok est la comment tu sais que le user c'est un client et lequel c'est, ou que c'est une assistante et laquelle c'est :p
    //heu la jss perdu
    // bin tu créer un compte au depart, et ca te créer un user (pas un Client deja), donc du coup faut relier user a client
    // en gros ton user ca peut etre soit un client soit une assistante maternelleok

    // du coup y a un truc que je comprend pas ds ton outils, c'est l'assistante maternelle qui créer les comptes des parents
    // sinon comme savoir s'il s'inscrive faut rentrer leur enfant, et l'assistante maternelle ?
    // bin au depart les parents et lassistmat signe un contrat un fois ke c signer
    // lassismatt creer un compte pour le parent et fournit acces
    // oké donc c'est l'assistante maternelle qui créer le compte clientouii voilo
    // et tu devoir te taper l'admin de tout ca ? genre va falloir rentrer les gosses, les nom, ect ? voilaaa
    // dans l'admin assistante maternelle y aura un onglet mes clients et créer un nouvau client avec le formulaire et tout ?exact
    // ok

    /**
     * @var Client
     * @ORM\OneToOne(targetEntity="Client", cascade={"persist"}, inversedBy="user")
     */
    private $client;

    /**
     * @var AssistanteMaternelle
     * @ORM\OneToOne(targetEntity="AssistanteMaternelle", cascade={"persist"}, inversedBy="user")
     */
    private $assistanteMaternelle;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $lastname;

    public function getFullName()
    {
        return $this->firstname . " " . $this->lastname;
    }

    public function isAdmin()
    {
        return $this->hasRole("ROLE_ADMIN");
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     * @return User
     */
    public function setClient(Client $client): User
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return AssistanteMaternelle
     */
    public function getAssistanteMaternelle(): AssistanteMaternelle
    {
        return $this->assistanteMaternelle;
    }

    /**
     * @param AssistanteMaternelle $assistanteMaternelle
     * @return User
     */
    public function setAssistanteMaternelle(AssistanteMaternelle $assistanteMaternelle): User
    {
        $this->assistanteMaternelle = $assistanteMaternelle;
        return $this;
    }

    public function isClient()
    {
        return $this->client != null;
    }

    public function isAssistanteMaternelle()
    {
        return $this->assistanteMaternelle != null && $this->hasRole("ROLE_ADMIN");
    }
}
