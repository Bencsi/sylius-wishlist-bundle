<?php

namespace Webburza\Sylius\WishlistBundle\Remover;

use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Webburza\Sylius\WishlistBundle\Repository\WishlistItemRepositoryInterface;

class ExpiredPriceLocksRemover
{
    /**
     * @var WishlistItemRepositoryInterface
     */
    private $wishlistItemRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var string
     */
    private $expirationPeriod;

    /**
     * @param WishlistItemRepositoryInterface $wishlistItemRepository
     * @param EntityManagerInterface          $wishlistItemManager
     * @param string                          $expirationPeriod
     */
    public function __construct(
        WishlistItemRepositoryInterface $wishlistItemRepository,
        EntityManagerInterface $entityManager,
        string $expirationPeriod
    ) {
        $this->wishlistItemRepository = $wishlistItemRepository;
        $this->entityManager          = $entityManager;
        $this->expirationPeriod       = $expirationPeriod;
    }

    public function remove(): void
    {
        $expiredPriceLocks = $this->wishlistItemRepository->findPriceLocksNotModifiedSince(new DateTime('-'.$this->expirationPeriod));

        foreach ($expiredPriceLocks as $expiredPriceLock) {
            $this->entityManager->remove($expiredPriceLock);
        }

        $this->entityManager->flush();
    }
}
