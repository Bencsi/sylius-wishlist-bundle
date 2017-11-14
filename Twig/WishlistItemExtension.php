<?php

namespace Webburza\Sylius\WishlistBundle\Twig;

use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Core\Calculator\ProductVariantPriceCalculatorInterface;
use Twig_Extension;
use Twig_SimpleFunction;
use Webburza\Sylius\WishlistBundle\Model\WishlistItemInterface;

/**
 * WishlistItemExtension.
 *
 * @author Matthijs Hasenpflug <matthijs@connectholland.nl>
 */
class WishlistItemExtension extends Twig_Extension
{
    /**
     * @var ProductVariantPriceCalculatorInterface
     */
    private $productVariantPriceCalculator;

    /**
     * @var array
     */
    private $context;

    /**
     * @var bool
     */
    protected $priceLock;

    /**
     * WishlistItemExtension.
     *
     * @param ProductVariantPriceCalculatorInterface $productVariantPriceCalculator
     * @param bool                                   $priceLock
     */
    public function __construct(
        ProductVariantPriceCalculatorInterface $productVariantPriceCalculator,
        ChannelContextInterface $channelContext,
        bool $priceLock
    ) {
        $this->productVariantPriceCalculator = $productVariantPriceCalculator;
        $this->context                       = ['channel' => $channelContext->getChannel()];
        $this->priceLock                     = $priceLock;
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('wishlist_item_get_price', [$this, 'getPrice']),
        ];
    }

    /**
     * returns ral colors.
     *
     * @param WishlistItemInterface $item
     *
     * @return int
     */
    public function getPrice(WishlistItemInterface $item)
    {
        if ($this->priceLock) {
            return $item->getPrice();
        }

        return $this->productVariantPriceCalculator->calculate($item->getProductVariant(), $this->context);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string
     */
    public function getName()
    {
        return 'wishlist_item_extension';
    }
}
