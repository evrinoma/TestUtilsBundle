<?php


namespace Evrinoma\TestUtilsBundle\DependencyInjection;

use Evrinoma\TestUtilsBundle\EvrinomaTestUtilsBundle;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
//region SECTION: Getters/Setters
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder(EvrinomaTestUtilsBundle::TEST_BUNDLE);
        $rootNode    = $treeBuilder->getRootNode();

        return $treeBuilder;
    }
//endregion Getters/Setters
}
