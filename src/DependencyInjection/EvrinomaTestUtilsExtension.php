<?php


namespace Evrinoma\TestUtilsBundle\DependencyInjection;

use Evrinoma\TestUtilsBundle\EvrinomaTestUtilsBundle;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class EvrinomaTestUtilsExtension extends Extension
{

    private $container;


    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
    }


    public function getAlias()
    {
        return EvrinomaTestUtilsBundle::TEST_UTILS_BUNDLE;
    }

}