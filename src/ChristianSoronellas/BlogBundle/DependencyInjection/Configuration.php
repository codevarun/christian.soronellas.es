<?php

namespace ChristianSoronellas\BlogBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('christian_soronellas_blog');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $rootNode
            ->children()
                ->arrayNode('feed_meta')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('title')->defaultValue('Christian Soronellas Web Architect')->end()
                        ->scalarNode('link')->defaultValue('http://christian.soronellas.es')->end()
                        ->arrayNode('feed_link')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('url')->defaultValue('http://christian.soronellas.es/feed')->end()
                                ->scalarNode('type')->defaultValue('rss')->end()
                            ->end()
                        ->end()
                        ->arrayNode('author')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('name')->defaultValue('Christian Soronellas')->end()
                                ->scalarNode('email')->defaultValue('christian@sistemes-cayman.es')->end()
                                ->scalarNode('uri')->defaultValue('http://christian.soronellas.es')->end()
                            ->end()
                        ->end()
                        ->scalarNode('copyright')->defaultValue('Christian Soronellas')->end()
                        ->scalarNode('description')->defaultValue('Este es el blog de Christian Soronellas Vallespí, dedicado a arquitectura web')->end()
                    ->end()
                ->end()
                ->scalarNode('feed_path')->cannotBeEmpty()->isRequired()->end()
            ->end();

        return $treeBuilder;
    }
}
