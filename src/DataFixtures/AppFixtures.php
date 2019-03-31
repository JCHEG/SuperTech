<?php

namespace App\DataFixtures;

use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Produit;
use App\Entity\Categorie;
use Doctrine\Common\Collections\ArrayCollection;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();

        $catNiv1 = new ArrayCollection();
        $catNiv2 = new ArrayCollection();
        $catNiv3 = new ArrayCollection();


        for ($i = 0; $i < 5; $i++)
        {
            $cat = new Categorie();
            $cat->setNom('Catégorie ' . $faker->word)
                ->setDescription('Catégorie ' . $faker->text)
                ->setOrdre($i)
                ->setCategorie($cat);

            $manager->persist($cat);
            $catNiv1->add($cat);
        }

        $j = 0;
        for ($i = 0; $i < 25; $i++)
        {
            if($j == 5){ $j = 0; }
            $cat = new Categorie();
            $cat->setNom('Sous Catégorie ' . $faker->word)
                ->setDescription('Sous Catégorie ' . $faker->text)
                ->setOrdre($i)
                ->setCategorie($catNiv1->get($j));

            $manager->persist($cat);
            $catNiv2->add($cat);
            $j++;
        }

        $j = 0;
        for ($i = 0; $i < 125; $i++)
        {
            if($j == 25){ $j = 0; }
            $cat = new Categorie();
            $cat->setNom('Sous Sous Catégorie ' . $faker->word)
                ->setDescription('Sous Sous Catégorie ' . $faker->text)
                ->setOrdre($i)
                ->setCategorie($catNiv2->get($j));

            $manager->persist($cat);
            $catNiv3->add($cat);
            $j++;
        }

        $j = 0;
        for ($i = 0 ; $i < 1250; $i++)
        {
            if($j == 125){ $j = 0; }
            $produit = new Produit();
            $produit->setLibelle($faker->word)
                ->setCodebarre($faker->ean13)
                ->setCodeFournisseur($faker->ean8)
                ->setConditionnement($faker->randomDigit)
                ->setDescription($faker->text)
                ->setEnAvant(false)
                ->setEnSolde(false)
                ->setEnVente(true)
                ->setPrixAchat($faker->randomDigit)
                ->setPrixHT($faker->randomDigit)
                ->setPrixTTC($faker->randomDigit)
                ->setTaille($faker->randomLetter)
                ->setTva(0.2)
                ->setCategorie($catNiv3->get($j));
            for ($k = 0 ; $k < 4; $k++){
                $image = new Image();
                $image->setUrl($faker->imageUrl($width = 115, $height = 115))
                    ->setAlt($faker->word);
                    //->setProduit($produit);
                    $produit->addImages($image);
                $manager->persist($image);
            }

            $manager->persist($produit);
            $j++;
        }

        $manager->flush();
    }
}
