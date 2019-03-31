<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle')
            ->add('description')
            ->add('prixHT')
            ->add('enSolde')
            ->add('enAvant')
            ->add('categorie')
            ->add('codebarre')
            ->add('codeFournisseur')
            ->add('taille')
            ->add('conditionnement')
            ->add('prixAchat')
            ->add('image')
            ->add('tva')
            ->add('enVente')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
