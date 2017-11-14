<?php

namespace Webburza\Sylius\WishlistBundle\Model;

use Sylius\Component\Core\Model\ProductVariantInterface;
use Sylius\Component\Resource\Model\TimestampableTrait;

class WishlistItem implements WishlistItemInterface
{
    use TimestampableTrait;

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var int
     */
    protected $price;

    /**
     * @var WishlistInterface
     */
    protected $wishlist;

    /**
     * @var ProductVariantInterface
     */
    protected $productVariant;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price
     *
     * @return WishlistItemInterface
     */
    public function setPrice(?int $price)
    {
        $this->price = $price;
    }

    /**
     * @return WishlistInterface
     */
    public function getWishlist()
    {
        return $this->wishlist;
    }

    /**
     * @param WishlistInterface $wishlist
     *
     * @return WishlistItemInterface
     */
    public function setWishlist(WishlistInterface $wishlist)
    {
        $this->wishlist = $wishlist;

        return $this;
    }

    /**
     * @return ProductVariantInterface
     */
    public function getProductVariant()
    {
        return $this->productVariant;
    }

    /**
     * @param ProductVariantInterface $productVariant
     *
     * @return WishlistItemInterface
     */
    public function setProductVariant(ProductVariantInterface $productVariant)
    {
        $this->productVariant = $productVariant;

        return $this;
    }
}
