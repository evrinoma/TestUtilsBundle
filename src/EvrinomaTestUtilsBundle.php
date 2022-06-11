<?php


namespace Evrinoma\TestUtilsBundle;

use Evrinoma\TestUtilsBundle\DependencyInjection\EvrinomaTestUtilsExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaTestUtilsBundle extends Bundle
{
    public const TEST_UTILS_BUNDLE = 'Test';


    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaTestUtilsExtension();
        }

        return $this->extension;
    }

}