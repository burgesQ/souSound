<?php

namespace App\Repository;

use App\Entity\DownloadUtil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

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
    public function findDownloadToScrapByUser($userId) : array
    {
        $qb = $this->_em->createQuery('
            SELECT d FROM App\Entity\DownloadUtil d
            WHERE d.user = ' . $userId . '
            GROUP BY d.type
        ');

        return $qb->execute();
    }
}
