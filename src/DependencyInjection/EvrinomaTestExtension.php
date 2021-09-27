<?php


namespace Evrinoma\TestBundle\DependencyInjection;

use Evrinoma\TestBundle\EvrinomaTestBundle;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Class EvrinomaTestExtension
 *
 * @package Evrinoma\TestBundle\DependencyInjection
 */
class EvrinomaTestExtension extends Extension
{
//region SECTION: Fields
    private $container;
//endregion Fields

//region SECTION: Public
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
//endregion Public


//region SECTION: Getters/Setters
    public function getAlias()
    {
        return EvrinomaTestBundle::TEST_BUNDLE;
    }
//endregion Getters/Setters
}