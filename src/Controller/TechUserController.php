<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TechUserController extends AbstractController
{
    /**
     * @Route("/tech/user", name="tech_user")
     */
    public function index()
    {
        return $this->render('tech_user/index.html.twig', [
            'controller_name' => 'TechUserController',
        ]);
    }
}
