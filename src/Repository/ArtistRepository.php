<?php

namespace App\Repository;

use App\Entity\Artist;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Bridge\Doctrine\RegistryInterface;

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
            ->join("a.tracks", "t")
            ->where("t.id IN(:tracksId)")
            ->setParameter('tracksId', (function ($user) {
                $retIds = [];
                foreach ($user->getPlaylists() as $playlist)
                    foreach ($playlist->getTracks() as $track)
                        foreach ($track->getArtists() as $artist)
                            if (!in_array($artist->getId(), $retIds))
                                $retIds[] = $artist->getId();
                return $retIds;
            })($user) )
            ->getQuery()
            ->getResult()
            ;
    }
}
