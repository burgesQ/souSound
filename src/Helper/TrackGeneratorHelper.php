<?php

namespace App\Helper;

use Doctrine\ORM\EntityManager;
use App\Entity\TrackMetadata;
use App\Entity\DownloadUtil;
use App\Entity\Playlist;
use App\Entity\Artist;
use App\Entity\Track;
use App\Entity\User;

Trait TrackGeneratorHelper
{
    /**
     * @var array
     */
    private $arrayType = [
        1 => "YouTube",
        2 => "SoundCloud"
    ];

    /**
     * Create a playlist for a given downloadUtil.
     *
     * @param DownloadUtil                $util
     * @param \App\Entity\User            $user
     * @param \Doctrine\ORM\EntityManager $em
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function createPlaylist(DownloadUtil $util, User $user, EntityManager $em)
    {
        $playlist = new Playlist($this->arrayType[$util->getType()] . '_user_' . $user->getId());
        $em->persist($playlist);
        $em->flush($playlist);

        $user->addPlaylist($playlist);
        $util->setPlaylist($playlist);
        $em->flush();
    }

    /**
     * Create a track in db from a fileName.
     *
     * @param string                      $file
     * @param string                      $path
     * @param \App\Entity\DownloadUtil    $util
     * @param \Doctrine\ORM\EntityManager $em
     * @param string                      $basePath
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function createTrack(string $file, string $path, DownloadUtil $util, EntityManager $em, string $basePath)
    {
        /** @var array $trackInfo */
        $trackInfo = explode(" - ", $file, 2);
        /** @var Track $track */
        $track     = new Track(explode(".mp3", $trackInfo[1], 1)[0]);
        $em->persist($track);
        $em->flush($track);

        /** @var TrackMetadata $meta */
        $meta = new TrackMetadata($file, $path, $basePath);
        $em->persist($meta);
        $em->flush($meta);

        $track->setMetadata($meta);

        $this->createArtist($track, $file, $em);

        $util->getPlaylist()->addTrack($track);
        $em->flush();
    }

    /**
     * Define, create and link track to artist.
     *
     * TODO : b2b
     * TODO : XX and YY
     * TODO : XX & YY
     * TODO : TrackName - ArtistName.
     *
     * @param \App\Entity\Track           $track
     * @param string                      $file
     * @param \Doctrine\ORM\EntityManager $em
     * @return \App\Entity\Artist
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function createArtist(Track $track, string $file, EntityManager $em): Artist
    {
        /** @var array $trackInfo */
        $trackInfo = explode(" - ", $file, 2);

        /** @var Artist $artist */
        if (!($artist = $em->getRepository(Artist::class)->findOneBy(['artist' => $trackInfo[0]]))) {
            $artist = new Artist($trackInfo[0]);
            $em->persist($artist);
            $em->flush($artist);
        }

        $track->addArtist($artist);
        $em->flush();

        return $artist;
    }
}
