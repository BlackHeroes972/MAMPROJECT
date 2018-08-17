<?php

namespace AppBundle\Form;

use AppBundle\Entity\CarnetLiaison;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarnetLiaisonType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        // pour voir tous les formtype disponible dans symfony
        // http://symfony.com/doc/current/reference/forms/types.html
        // les plus dur c'est les collections c'est des trucs avec ajout et supression directement dans la liste
        // dans la mesure du possible evite et fait les listes toi meme tu va souffrir dessus :p wep lol
        // ah est typiquement pour ton carnet de liaison c'est un knppaginator parce que si ta un 1 de log
        // tu va pas en afficher 365 donc faut paginer le resultats mais bon on va pas faire ca ce soir :p
        // je vais te laisser avancer et on peaufinera ensuite :p
        //OK EN TT CAS MERCI BCP de rien si tu veux voir a quoi ressemble knpPginator ca fait ca
        $builder
            // dans les formulaire ta plein de types symfony il existe un type date que tu peux configurer
                // pour aller avec les widget boostrap de datepicker, donc j'ai ajouter la class js-datepicker
                // et ensuite je l'ai connecté en javacript
            ->add('date', DateType::class, array(
                        'widget' => 'single_text',
                        "required" => false,
                        'html5' => false,
                        'format' => 'dd/MM/yyyy',
                        'attr' => ['class' => 'js-datepicker', 'autocomplete' => 'off'],
                        'label' => "Date"
                    ))

            // il existe un type choice qui permet de faire des selecteurs
                // je l'ai réglé sur multiple = true car il a plusieurs choix possible
                // et je lui ai donner comme combinaison de choix la constante de classe ACTIVITES
                // bref ta plein de type tout fait que tu peux réutilisé directement
                // il faut juste apprendre les arguments ou aller matter la doc a chaque fois comme je vois quoi :p
                // et donc j'ai ajouter en javascript sur l'id du formulaire le déclenchement de select2
                ->add('activites', ChoiceType::class, [
                    'choices' => CarnetLiaison::ACTIVITES,
                    'label' => "Les Activités",
                    'multiple' => true,
                ])
            ->add('repas')
            ->add('consignes')
            ->add('important');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CarnetLiaison'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_carnetliaison';
    }


}
