<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @Route(
     *     "/hello/{name}",
     *     requirements={"name" = "\w"},
     *     defaults={"name" = "caca"}
     * )
     *
     * @param $name
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($name)
    {
        return $this->render('hello.html.twig', [
            'name' => $name
        ]);
    }

    /**
     * @Route(
     *     "/"
     * )
     * @return Response
     */
    public function baseAction()
    {
        return new Response("helloWorld");
    }
}