<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Produit;
use App\Entity\Categorie;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
     private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

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
                ->setNiveau($i)
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
                ->setNiveau($i)
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
                ->setNiveau($i)
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

        $user = new User();
        $user->setPassword($this->passwordEncoder->encodePassword(
                 $user,
                '132456'))
            ->setNom($faker->name)
            ->setPrenom($faker->firstName)
            ->setAdresse($faker->address)
            ->setCodePostal($faker->postcode)
            ->setEmail('email@gamil.com')
            ->setTel($faker->phoneNumber)
        ;
        $manager->persist($user);

        for($i = 0 ; $i < 30 ; $i++)
        {
            $user = new User();
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                '132456'))
                ->setNom($faker->name)
                ->setPrenom($faker->firstName)
                ->setAdresse($faker->address)
                ->setCodePostal($faker->postcode)
                ->setEmail($faker->email)
                ->setTel($faker->phoneNumber)
            ;
            $manager->persist($user);
        }

        $manager->flush();
    }
}
