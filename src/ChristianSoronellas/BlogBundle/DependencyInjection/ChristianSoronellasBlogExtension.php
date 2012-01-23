<?php

namespace ChristianSoronellas\BlogBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class ChristianSoronellasBlogExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        
        // Bind all the config variables
        $container->setParameter('christian_soronellas_blog.feed_meta.title', $config['feed_meta']['title']);
        $container->setParameter('christian_soronellas_blog.feed_meta.link', $config['feed_meta']['link']);
        $container->setParameter('christian_soronellas_blog.feed_meta.feed_link.url', $config['feed_meta']['feed_link']['url']);
        $container->setParameter('christian_soronellas_blog.feed_meta.feed_link.type', $config['feed_meta']['feed_link']['type']);
        $container->setParameter('christian_soronellas_blog.feed_meta.author.name', $config['feed_meta']['author']['name']);
        $container->setParameter('christian_soronellas_blog.feed_meta.author.email', $config['feed_meta']['author']['email']);
        $container->setParameter('christian_soronellas_blog.feed_meta.author.uri', $config['feed_meta']['author']['uri']);
        $container->setParameter('christian_soronellas_blog.feed_meta.copyright', $config['feed_meta']['copyright']);
        $container->setParameter('christian_soronellas_blog.feed_meta.description', $config['feed_meta']['description']);
        $container->setParameter('christian_soronellas_blog.feed_path', $config['feed_path']);
        
        $loader->load('services.xml');
    }
}
