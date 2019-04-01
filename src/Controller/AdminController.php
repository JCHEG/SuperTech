<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\User;
use App\Repository\ProduitRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProduitType;
use App\Form\UserType;
use Knp\Component\Pager\PaginatorInterface;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {

        return $this->render('admin/index.html.twig');
    }
    /**
     * @Route("/admin-users", name="admin.users")
     */
    public function users( ObjectManager $manager, Request $request, PaginatorInterface $paginator)
    {
        $query = $manager->createQuery(  "SELECT DISTINCT u FROM App\Entity\User u");

        $listUser = $paginator->paginate(
            $query,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            10/*nbre d'éléments par page*/
        );
        return $this->render('admin/users.html.twig', [
            'listUser' => $listUser,
        ]);
    }

    /**
     * @Route("/admin-user-supprimer-{id}", name="admin.user.supprimer")
     */
    public function supprimerUser(ObjectManager $manager, User $user)
    {
        //$user = $userRepository->find($id);
        $manager->remove($user);
        $manager->flush();

        return $this->redirectToRoute("admin.users");
    }

    /**
     * @Route("/admin-user-modif-{id}", name="admin.user.modif")
     */
    public function modifUser(Request $request, ObjectManager $manager, User $user )
    {
        //$user = $userRepository->findOneBy(['id' => $id]);
        $form = $this->createForm(UserType::class, $user);
        if($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $manager->persist($user);
                $manager->flush();
                return $this->redirectToRoute("admin.users");
            }
            //dump($produit);//afficher dans le debugger tout à droite
        }
        return $this->render('admin/modifUser.html.twig', [
            'produit' => $user,
            'formUser' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin-produits", name="admin.produits")
     */
    public function produits( ObjectManager $manager, Request $request, PaginatorInterface $paginator)
    {
        $query = $manager->createQuery(  "SELECT DISTINCT p FROM App\Entity\Produit p");

        $listProd = $paginator->paginate(
            $query,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            50/*nbre d'éléments par page*/
        );
        return $this->render('admin/produits.html.twig', [
            'listProd' => $listProd,
        ]);
    }

    /**
     * @Route("/admin-produit-modif-{id}", name="admin.produit.modif")
     */
    public function modifProduit(Request $request, ObjectManager $manager, Produit $produit )
    {

        $form = $this->createForm(ProduitType::class, $produit);
        if($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $manager->persist($produit);
                $manager->flush();
                return $this->redirectToRoute("admin.produits");
            }
            //dump($produit);//afficher dans le debugger tout à droite
        }
        return $this->render('admin/modifProduit.html.twig', [
            'user' => $produit,
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
                return $this->redirectToRoute("admin.produits");
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
    public function supprimerProduit(ObjectManager $manager, Produit $produit )
    {
        //$produit = $produitRepository->find($id);
        $manager->remove($produit);
        $manager->flush();

        return $this->redirectToRoute("admin.produits");
    }
}
