<?php

namespace App\Controller;

use App\Entity\Artist;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/view")
 */
class ViewController extends Controller
{

    /**
     * @Route("/by_artist")
     *
     **/
    public function byArtistAction()
    {
        return $this->render('api/artist.html.twig', [
            'artistes' => $this->getDoctrine()->getRepository(Artist::class)
                ->findByUser($this->getUser())
        ]);
    }

}