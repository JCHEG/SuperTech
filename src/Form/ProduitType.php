<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Image;
use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('description')
            ->add('prixHT')
            ->add('categorie', EntityType::class,
                ['class' => Categorie::Class])
            ->add('codeBarre')
            ->add('codeFournisseur')
            ->add('taille')
            ->add('conditionnement')
            ->add('prixAchat')
            ->add('tva')
            ->add('enVente')
            ->add('enSolde')
            ->add('enAvant')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
