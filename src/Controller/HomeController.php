<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * @Route("/home")
     *
     * @return Response
     */
    public function homeAction() : Response
    {
        return $this->render('home.html.twig', [
            'home' => true
        ]);
    }

}