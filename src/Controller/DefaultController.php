<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @Route(
     *     "/{name}",
     *     requirements={"name" = "\w"},
     *     defaults={"name" = "caca"}
     * )
     *
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($name)
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_home_home');
        }

        return $this->render('hello.html.twig', [
            'name' => $name
        ]);
    }

}