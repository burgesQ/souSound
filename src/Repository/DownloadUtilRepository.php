<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\DownloadUtil;

class DownloadUtilRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DownloadUtil::class);
    }

    /**
     * @param $userId
     * @return DownloadUtil[]
     */
    public function findDownloadToScrapByUser($userId): array
    {
        $qb = $this->_em->createQuery('
            SELECT d FROM App\Entity\DownloadUtil d
            WHERE d.user = ' . $userId . '
            GROUP BY d.type
        ');

        return $qb->execute();
    }
}
