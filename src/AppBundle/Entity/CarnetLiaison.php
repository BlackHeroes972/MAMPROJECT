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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CarnetLiaisonRepository")
 * @ORM\Table(name="CarnetLiaison")
 */
class CarnetLiaison
{

    // les activites sauver en BDD on pourait dire Dession un D par exemple ca ce que tu aura en bdd mais on va laisser
    // comme ca ce sera plus claire en bdd mais faudra plus les changer c'est des constantes qui vont etre sauver en base
    const ACTIVITE_DESSIN = "Dessin";
    const ACTIVITE_PEINTURE = "Peinture";
    const ACTIVITE_JEUX = "Jeux";
    const ACTIVITE_PROMENADE = "Promenade";
    const ACTIVITE_CREATION = "Création";


    // pour créer le selecteur en html, premier param la key, deuxieme param le text qui va s'affichage en html
    // ton projet il tourne en php 7 ou 7.2 ? tu avais changer non? en 72
    const ACTIVITES =[
        self::ACTIVITE_DESSIN => "Dessin",
        self::ACTIVITE_PEINTURE => "Peinture",
        self::ACTIVITE_JEUX => "Jeux",
        self::ACTIVITE_PROMENADE => "Promenade",
        self::ACTIVITE_CREATION => "Création",
    ];

    // deja ecrit moi toute les activités en constante la c fini ? y en a 5

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * tes activites c du texte libre ou ta le choix parmis des activités fixé ? g du choix soit promenade soit dessin soit peinture soit jeux educatifs
     * donc la ta deux choix soit tu creer une entité activite et tu fait une ManyToone et tu manage aussi les activités
     * soit tu dit que les activités sont fixé en dur dans le code et tu fais un vecteur d'acitvité que tu passe en constante
     * en dure ca change pas c tjrs pareil et tu peux sauvegarder directement un arrayok
     * et dans le form faudra créer un type Choice avec les different possibilité :p tu sais le faire ? ca on la pas fe ca
     * tu peux avoir plusieurs acitivé dans la memes journée je supose ?oui donc c un multi select :)
     * deux choix soi tu le laisse en texte et tu tape a chaque fois a la main soit tu fait ce que j'ai dit et tu créer un
     * multi select genre select2 je peux te montre rapidos a la limite mais va falloir t'accrocher a ton slip dacc
     * @ORM\Column(type="array", nullable=true)
     */
    private $activites = [];


    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $repas;

    /**
     * consigne c perso dc visible ke par les parents dun enfant
     *
     * @ORM\Column(type="text", length=250, nullable=true)
     */
    private $consignes;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $important;

    // un enfant peut avoir 1 seul carnet de liaison et un carnet de liaison peut apartir qu'a un seul enfant alors ouai oneToOne
    // apres je pige pas trop ce que c ton entité carnet de liaison, pour moi dans carnet de liaison tu as des listes de trucs
    // et la apparement il a que des string
    //en faite carnet de liaison c pour ke les parents puiss voir ske lenfant fait ds la journee donc ya pratiqmt ke du texte koi
    // et chaque jour tu remplace tu garde par le truc du jour d'avant ? chaque jour tu fais une page de la journee de lenfant
    // ke tu gardes et ki reste consultable, du coup ton carnet de liaison c'est un ensemble de page la je vois pas comment tu va faire
    // ou alors tu creer un carnet de liaison par jour ? oui
    //// alors du coup c'est pas une oneToOne un enfant peut avoir plusieurs carnetdeLiaison et un carnet de liaison un seul enfant
    /// et c pas vraiment l'entité carnet de liaison mais l'entité rapportJournalier et le carnetdeliaison c'est audessus
    /// bon apres c'est de la sémantique tu fais comme tu veux je comprends ske tu dis jnavais pas vu cette partie comme ça
    /// ta le choix soit tu rajoute plein d'entré a un enfant c ce que t'es entrain de faire eet c pas vraiment un carnet de liaison
    /// et sur la liste tu affichage toutes les entré pour un enfant donné (ce qui créer sur la page une sorte de cahier de laison
    /// soit tu fait une éntité au dessus encore et tu la charge ce qui te sort directe les truc du gamin ca fait un niveau en plus
    /// mais si ta des info propre au carnet de liaison l'entité existe et c'est pas juste une liste
    /// heuu je pense ke ca serait mieu comsa ... tu me conseillles koi, et ce que le carnet de liaison a des info qui lui sont propre
    /// et qui se repeteoui ouiii, du coup le carnet de laison ce sera un truc genre id, nomDuCarnet, activites <<< liste des activités jounraliere dans une autre entitité
    /// qui a elle meme ses propres attributs ect ah daccord pas bete mais ca fait une entité et des jointures en plus
    /// du coup faut vraiment que ca vaille la peine et que t'es des info propre au carnet de liaison que tu peux pas mettre
    /// dans les trucs quotidien ou alors qui se repeterai toujours la meme chose dans chaque truc quotidient
    /// bin dans ce carnet tt se repete chaque jour donc , oui mais je sais pas comment expliqué
    /// imagine ta une site de ecommerce ta une entité panier, et dans le panier y a les produits
    /// mais au final si ton panier y a rien d'autre que les produit dedans t'en a pas besoin tu met directe la liste des produits
    /// par contre si tu as d'autre information dedans genre l'adresse ou un taux de reduction global bin le panier a une raison d'exister
    /// si ton carnet de liaison c'est juste id et activitesjournaliere y a pas de raison d'exister tu met directe les activité journaliere
    /// a l'enfant ah daccord je compren ske tu veux dire mais le pb cest que jai fait de mce carnet de liaison un element du site important
    /// je ss perdu
    ///
    /// en gros tu as tout un tas de variable que tu dois remplir chaque jour, et l'ensemble de ces jours formes le carnet de liaison
    /// si le carnet de liaison c'est juste l'ensemble de tout ces jours et rien d'autre alors pas besoin de creer l'entité carnetLiaison
    /// ce que tu as a fait est suffisant, par contre si ta des truc propre au carnet de liaison qui depends pas des jours
    /// alors il a une raison d'exister
    /// ouais paske en faite jai fait le carnet de liaison pour par exemple dire ke chak jour yoya une activite differente
    /// un repas different ..... dun jour a lautre SA JOURNEE SERA differente
    /// oké donc y a rien qui existe en dehors du truc de la journée donc tu peux faire comme ca
    /// mais pour moi l'entité c'est plus ProgrammeDuJour que carnetDeLiaison mais ok
    /// mince je te cherchait un exmple un truc de ce zstyle , ok sauf que la cetait une semaine, ouai donc rien n'existe en dehors du jour
    /// exoact, donc c'est oké est c pas une oneToOne mais une ManyToOne
    /// et du coup ca depend de l'enleve ou pas ou c pareil pour tout le monde ,
    /// parce que du coup j'imagine que c la nounou qui se charge du programme
    /// donc tout les enfants avec la meme nounou on le meme programme
    /// du coup c plutot a la nounou qui faut le relier  non ?
    /// ah bin oui c relier a la nounou ok ok c ca, oké donc c une manytoone AssistanteMaternelle -> CarnetDeLiaison
    /// meme si je trouve que CarnetDeLiaison ca sonne pas bien parce que qd tu va l'appeler tu va faire getCarnetDeLiaisons()
    /// on a l'impression qui a plusieurs carnet de liaison :p oui je compren bon apres c sémantique on s'en fou
    /// jai ete face a un gros dilemne o debut par rapport à c  a mais c vrai ke ton raisonnement est vrai
    /// ds ma tete c t un carnet avec d pages koi
    /// bin la ton entité c'est page :)arfff et le carnet c'est l'ensemble des pages mais bon on s'en fou
    /// on saura que carnetDeliaison dans ton outils ca veu dire rapport de la journée
    /// voila

    // alors une assistante maternelle peut avoir plusieurs carnet de liaison voila
    //mais c le meme pour tous les enfants quelle garde, y a pas dinfoi propre a l'enfant dedans genre ces notes
    // ou son attitude c vraiment juste les activités quelle va faire elle avec tous les enfants
    // le carnet est personnel donc le parent peut voir ke son carnet de son gosse en se connectant pas les otr
    // mais y a des infos sur sont gosse dessus ou c juste des info générique et tous les gosses de la nonou
    // on le meme carnet du coup, genre la nounou elle va devoir remplir un seul carnet par jour
    // ou autant de carnet qui a de gosse
    //chq jour elle devra remplie un carnet et y mettre dans consigne d consigne pour les parents
    // genre nest pas propore etc c person
    // du coup si elle a 50 enfant elle doit remplir 50 cahier de liaison par jour autant ce flinguer quoi
    // c vrai arff keske tu me conseilles de fai
    // bin pour moi c des consigne générique genre on va faire de la peinture donc pensé a des fringues pourri
    // mais c vrai pour tous les enfants, elle donne pas des consigne a chaque gosse
    // surtout qu'elle doit remplir je supose avant les activités donc elle connait pas forcement les gosses
    // en gros soit on met le carnet sur le gamin, donc la faudra créer autant de carnet que de gamin
    // mais ils auront chacun le leur personnalisé, soit on fait un générique et ca donne en gros
    // une sorte de carnet générique pour tous les parents qui sache ce leur gamin va faire
    // mais tous les parents on le meme (si c la meme nounou)
    // jpars plus surr ça soit on met le carnet sur le gamin, donc la faudra créer autant de carnet que de gamin
    //    // mais ils auront chacun le leur personnalisédo
    // donc si elle doit remplir chaque jour et pas a la semaine pour 30 gamin ca lui fait 300x 30 carnet a remplir
    // mais elle nen a ke 3 jtrouv ke c faisable
    //enfait mon pb c ke je veux ke cha carnet soit priveee dc consultable ke par le parent de lenfant concerner
    // ok donc c sur enfant

    /**
     * @ORM\ManyToOne(targetEntity="Enfant", inversedBy="carnetLiaisons")
     */
    private $enfant;

    /**
     * @param Enfant $enfant
     * @return $this
     */
    public function setEnfant(Enfant $enfant)
    {
        $this->enfant = $enfant;
        return $this;
    }

    /**
     * @return Enfant
     */
    public function getEnfant()
    {
        return $this->enfant;
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
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     * @return CarnetLiaison
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
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

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

}
