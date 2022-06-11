<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\TestUtilsBundle\DependencyInjection;

use Evrinoma\TestUtilsBundle\EvrinomaTestUtilsBundle;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder(EvrinomaTestUtilsBundle::TEST_UTILS_BUNDLE);
        $rootNode    = $treeBuilder->getRootNode();

        return $treeBuilder;
    }
}
