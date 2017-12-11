<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Track;
use App\Entity\User;

class TrackRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Track::class);
    }

    /**
     * @param User $user
     *
     * @return Track[]
     */
    public function findByUser(User $user): array
    {
        return $this->createQueryBuilder('t')
            ->where("t.id IN(:tracksId)")
            ->setParameter('tracksId', (function ($user) {
                $retIds = [];
                foreach ($user->getPlaylists() as $playlist) {
                    foreach ($playlist->getTracks() as $track) {
                        if (!in_array($track->getId(), $retIds)) {
                            $retIds[] = $track->getId();
                        }
                    }
                }

                return $retIds;
            })($user))
            ->getQuery()
            ->getResult();
    }
}
