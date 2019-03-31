<?php

namespace App\Controller;

use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Produit;
use Knp\Component\Pager\PaginatorInterface;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produits", name="produits")
     */
    public function index(ProduitRepository $repository, ObjectManager $manager)
    {
        $produit = $repository->findOneBy(array('id' => 1) );
        $listProd = $repository->findAll();

        return $this->render('produit/index.html.twig', [
            'listProd' => $listProd,
        ]);
    }

    /**
     * @Route("/produits-{idCat}", name="produitsParCat")
     */
    public function produits(ProduitRepository $repository, CategorieRepository $categorieRepository, ObjectManager $manager, Request $request, PaginatorInterface $paginator, $idCat)
    {
        $query = $manager->createQuery(  "SELECT DISTINCT p FROM App\Entity\Produit p
                                        JOIN p.categorie cn3 JOIN cn3.categorie cn2 JOIN cn2.categorie cn1
                                        WHERE cn3.id= :id3 OR  cn2.id= :id2 OR  cn1.id= :id1 ORDER BY p.libelle ASC");
        $query->setParameters(array('id1' => $idCat, 'id2' => $idCat, 'id3' => $idCat));

        //$paginator = $this->get('knp_paginator');
        $listProd = $paginator->paginate(
            $query,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            20/*nbre d'éléments par page*/
        );

        return $this->render('produit/index.html.twig', [
            'listProd' => $listProd,
        ]);
    }
}
