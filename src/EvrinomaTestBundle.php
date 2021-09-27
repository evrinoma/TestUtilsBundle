<?php


namespace Evrinoma\TestBundle;


use Evrinoma\TestBundle\DependencyInjection\EvrinomaTestExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class EvrinomaTestBundle
 *
 * @package Evrinoma\TestBundle
 */
class EvrinomaTestBundle extends Bundle
{
    public const TEST_BUNDLE = 'Test';

//region SECTION: Getters/Setters
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaTestExtension();
        }

        return $this->extension;
    }
//endregion Getters/Setters
}