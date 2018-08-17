<?php
/**
 * Created by PhpStorm.
 * User: BlackHeroes972
 * Date: 08/08/2018
 * Time: 15:27
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="Adresse")
 */
class Adresse
{

    // adresse c'est lié a client je suppose oui et contrat aussi oui
    // bon je te laisserai faire les OneToOne
    //ok
    // vérifions deja si ca marche tout ca

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", length=3, nullable=true)
     */
    private $numero_rue;


    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $rue;

    /**
     * @ORM\Column(type="integer", length=5, nullable=true)
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=125, nullable=true)
     */
    private $ville;


    

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
     * Set numeroRue
     *
     * @param integer $numeroRue
     *
     * @return Adresse
     */
    public function setNumeroRue($numeroRue)
    {
        $this->numero_rue = $numeroRue;

        return $this;
    }

    /**
     * Get numeroRue
     *
     * @return integer
     */
    public function getNumeroRue()
    {
        return $this->numero_rue;
    }

    /**
     * Set rue
     *
     * @param string $rue
     *
     * @return Adresse
     */
    public function setRue($rue)
    {
        $this->rue = $rue;

        return $this;
    }

    /**
     * Get rue
     *
     * @return string
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * Set cp
     *
     * @param integer $cp
     *
     * @return Adresse
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return integer
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Adresse
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }
}
