<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Artist;
use App\Entity\User;

class ArtistRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Artist::class);
    }

    /**
     * @param User $user
     *
     * @return Artist[]
     */
    public function findByUser(User $user): array
    {
        return $this->createQueryBuilder('a')
            ->where("a.id IN(:artistId)")
            ->setParameter('artistId', (function ($user) {
                $retIds = [];
                foreach ($user->getPlaylists() as $playlist) {
                    foreach ($playlist->getTracks() as $track) {
                        foreach ($track->getArtists() as $artist) {
                            if (!in_array($artist->getId(), $retIds)) {
                                $retIds[] += $artist->getId();
                            }
                        }
                    }
                }
                return $retIds;
            })($user))
            ->getQuery()
            ->getResult();
    }
}
