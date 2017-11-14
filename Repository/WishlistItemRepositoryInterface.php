<?php

namespace Webburza\Sylius\WishlistBundle\Repository;

use DateTimeInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface WishlistItemRepositoryInterface extends RepositoryInterface
{
    /**
     * @return array
     */
    public function findPriceLocksNotModifiedSince(DateTimeInterface $terminalDate);
}
