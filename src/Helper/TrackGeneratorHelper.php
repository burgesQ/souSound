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

        // TODO : define method to match b2b
        /** @var Artist $artist */
        if (!($artist = $em->getRepository(Artist::class)->findOneBy(['artist' => $trackInfo[0]]))) {
            $track->addArtist($this->createArtist($trackInfo[0], $em));
        } else {
            $track->addArtist($artist);
        }

        $util->getPlaylist()->addTrack($track);
        $em->flush();
    }

    /**
     * @param string                                        $artistName
     * @param \Doctrine\ORM\EntityManager                   $em
     * @return \App\Entity\Artist
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function createArtist(string $artistName, EntityManager $em): Artist
    {
        $artist = new Artist($artistName);
        $em->persist($artist);
        $em->flush($artist);

        return $artist;
    }
}
