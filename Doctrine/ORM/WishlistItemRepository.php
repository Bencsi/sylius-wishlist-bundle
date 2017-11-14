<?php

namespace Webburza\Sylius\WishlistBundle\Doctrine\ORM;

use DateTimeInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Webburza\Sylius\WishlistBundle\Repository\WishlistItemRepositoryInterface;

class WishlistItemRepository extends EntityRepository implements WishlistItemRepositoryInterface
{
    /**
     * @return array
     */
    public function findPriceLocksNotModifiedSince(DateTimeInterface $terminalDate)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.updatedAt < :terminalDate')
            ->andWhere('w.price IS NOT NULL')
            ->setParameter('terminalDate', $terminalDate)
            ->getQuery()
            ->getResult()
        ;
    }
}
