<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Playlist;
use App\Entity\Artist;
use App\Entity\Track;

/**
 * @Route("/view")
 */
class ViewController extends Controller
{

    private $arrayClass = [
        'artist'   => [
            'route' => 'api/artist.html.twig',
            'class' => Artist::class
        ],
        'track'    => [
            'route' => 'api/track.html.twig',
            'class' => Track::class
        ],
        'playlist' => [
            'route' => 'api/playlist.html.twig',
            'class' => Playlist::class
        ]
        //        'album' => [
        //            'route' => 'api/album.html.twig',
        //            'class' => Album::class
        //        ],
        //        'kind' => [
        //            'route' => 'api/kind.html.twig',
        //            'class' => Kind::class
        //        ],
        //        'label' => [
        //            'route' => 'api/label.html.twig',
        //            'class' => Label::class
        //        ],
    ];

    /**
     * @Route("/rand")
     * @return \Symfony\Component\HttpFoundation\Response
     **/
    public function randomAction(): Response
    {
        return $this->render('api/track.html.twig', [
            'content' => $this->getDoctrine()->getRepository(Track::class)
                ->findAll()
        ]);
    }

    /**
     * @Route(
     *     "/{class}",
     *     requirements={
     *         "class"="artist|track|playlist"
     *     }
     * )
     *
     * @param string $class
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function byClassAction(string $class): Response
    {
        return $this->render($this->arrayClass[$class]['route'], [
            'content' => $this->getDoctrine()->getRepository($this->arrayClass[$class]['class'])
                ->findByUser($this->getUser())
        ]);
    }

}