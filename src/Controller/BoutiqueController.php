<?php
/**
 * Created by PhpStorm.
 * User: jamel
 * Date: 20/03/2019
 * Time: 15:32
 */

namespace App\Controller;


use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\ProduitRepository;
use Doctrine\Common\Persistence\ObjectManager;


class BoutiqueController extends AbstractController
{

    public function index(): Response
    {
        $x = random_int(10,20);
        return $this->render('boutique/index.html.twig', [
            'monX' => $x
        ]);
    }

    public function menu(CategorieRepository $repository, ObjectManager $manager): Response
    {
        $listCat = $repository->findCatFirstLevel();

        return $this->render('boutique/menu.html.twig', [
            'listCat' => $listCat
        ]);
    }

}