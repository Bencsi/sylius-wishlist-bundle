<?php

namespace Webburza\Sylius\WishlistBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('webburza_sylius_wishlist');

        $rootNode
            ->children()
                ->booleanNode('multiple')->end()
                ->booleanNode('default_public')->end()
                ->booleanNode('price_lock')->end()
                ->scalarNode('price_locks_expiration_period')->defaultValue('7 days')->cannotBeEmpty()->end()
            ->end();

        return $treeBuilder;
    }
}
