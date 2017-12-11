<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Playlist;
use App\Entity\User;

class PlaylistRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Playlist::class);
    }

    /**
     * @param User $user
     *
     * @return Playlist[]
     */
    public function findByUser(User $user): array
    {
        return $this->createQueryBuilder('p')
            ->where("p.owner = " . $user->getId())
            ->getQuery()
            ->getResult();
    }
}
