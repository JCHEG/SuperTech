<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProduitType;
use Knp\Component\Pager\PaginatorInterface;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(ProduitRepository $produitRepository, ObjectManager $manager, Request $request, PaginatorInterface $paginator)
    {
        $query = $manager->createQuery(  "SELECT DISTINCT p FROM App\Entity\Produit p");

        $listProd = $paginator->paginate(
            $query,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            50/*nbre d'éléments par page*/
        );
        return $this->render('admin/index.html.twig', [
            'listProd' => $listProd,
        ]);
    }

    /**
     * @Route("/admin-produit-modif-{id}", name="admin.produit.modif")
     */
    public function modifProduit(Request $request, ObjectManager $manager, ProduitRepository $produitRepository ,$id)
    {
        $produit = $produitRepository->findOneBy(['id' => $id]);
        $form = $this->createForm(ProduitType::class, $produit);
        if($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $manager->persist($produit);
                $manager->flush();
                return $this->redirectToRoute("admin");
            }
            //dump($produit);//afficher dans le debugger tout à droite
        }
        return $this->render('admin/modif.html.twig', [
            'produit' => $produit,
            'formProduit' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin-produit-ajout", name="admin.produit.ajout")
     */
    public function ajouterProduit(Request $request, ObjectManager $manager, ProduitRepository $produitRepository )
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class);

        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $manager->persist($produit);
                $manager->flush();
                return $this->redirectToRoute("admin");
            }
            dump($produit);//afficher dans le debugger tout à droite
        }


        return $this->render('admin/ajout.html.twig', [
            'formProduit' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin-produit-supprimer-{id}", name="admin.produit.supprimer")
     */
    public function supprimerProduit(ObjectManager $manager, ProduitRepository $produitRepository  , $id)
    {
        $produit = $produitRepository->find($id);
        $manager->remove($produit);
        $manager->flush();

        return $this->redirectToRoute("admin");
    }
}
