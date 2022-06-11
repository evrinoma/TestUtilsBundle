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
