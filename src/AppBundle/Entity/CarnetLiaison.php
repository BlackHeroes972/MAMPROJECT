<?php
/**
 * Created by PhpStorm.
 * User: BlackHeroes972
 * Date: 08/08/2018
 * Time: 15:13
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="CarnetLiaison")
 */
class CarnetLiaison
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", length=2, nullable=true)
     */
    private $semaine;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $activites;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $repas;

    /**
     * @ORM\Column(type="text", length=250, nullable=true)
     */
    private $consignes;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $important;



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
     * Set semaine
     *
     * @param integer $semaine
     *
     * @return CarnetLiaison
     */
    public function setSemaine($semaine)
    {
        $this->semaine = $semaine;

        return $this;
    }

    /**
     * Get semaine
     *
     * @return integer
     */
    public function getSemaine()
    {
        return $this->semaine;
    }

    /**
     * Set activites
     *
     * @param string $activites
     *
     * @return CarnetLiaison
     */
    public function setActivites($activites)
    {
        $this->activites = $activites;

        return $this;
    }

    /**
     * Get activites
     *
     * @return string
     */
    public function getActivites()
    {
        return $this->activites;
    }

    /**
     * Set repas
     *
     * @param string $repas
     *
     * @return CarnetLiaison
     */
    public function setRepas($repas)
    {
        $this->repas = $repas;

        return $this;
    }

    /**
     * Get repas
     *
     * @return string
     */
    public function getRepas()
    {
        return $this->repas;
    }

    /**
     * Set consignes
     *
     * @param string $consignes
     *
     * @return CarnetLiaison
     */
    public function setConsignes($consignes)
    {
        $this->consignes = $consignes;

        return $this;
    }

    /**
     * Get consignes
     *
     * @return string
     */
    public function getConsignes()
    {
        return $this->consignes;
    }

    /**
     * Set important
     *
     * @param string $important
     *
     * @return CarnetLiaison
     */
    public function setImportant($important)
    {
        $this->important = $important;

        return $this;
    }

    /**
     * Get important
     *
     * @return string
     */
    public function getImportant()
    {
        return $this->important;
    }
}
