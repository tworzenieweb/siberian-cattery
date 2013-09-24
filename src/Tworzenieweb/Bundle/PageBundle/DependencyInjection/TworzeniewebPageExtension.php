<?php

namespace Tworzenieweb\Bundle\PageBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class TworzeniewebPageExtension extends Extension
                                implements PrependExtensionInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
    }
    
    private function buildAsseticConfig(array $config)
    {
        return array(
            'local_js'  => $this->buildAsseticJsConfig($config),
        );
    }
    
    public function prepend(ContainerBuilder $container)
    {
        $this->configureAsseticBundle($container);
    }
    
    /**
     * Configures the AsseticBundle.
     *
     * @param ContainerBuilder $container The service container
     *
     * @return void
     */
    private function configureAsseticBundle(ContainerBuilder $container)
    {
        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);

        foreach ($container->getExtensions() as $name => $extension) {
            switch ($name) {
                case 'assetic':
                    $container->prependExtensionConfig(
                        $name,
                        array(
                            'assets'    => $this->buildAsseticConfig($config)
                        )
                    );
                    break;
            }
        }
    }
    
    private function buildAsseticJsConfig(array $config)
    {
        $dir = __DIR__ . '/../Resources/public/js/';
        $output = '';
        
        return array(
            'inputs'        => array(
                $dir . 'jquery-ui-1.10.2.custom.min.js',
                $dir . 'jquery.localScroll.min.js',
                $dir . 'jquery.magnific-popup.min.js',
                $dir . 'jquery.scrollTo-1.4.3.1-min.js',
                $dir . 'jquery.unveil.min.js',
                $dir . 'jquery.sequence-min.js',
                $dir . 'masonry.pkgd.min.js',
                $dir . 'app.js',
            ),
            'output'        => $output.'/js/local.js'
        );
    }
}
