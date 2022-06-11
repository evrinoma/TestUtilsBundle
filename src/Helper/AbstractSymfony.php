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

namespace Evrinoma\TestUtilsBundle\Helper;

use Symfony\Component\HttpKernel\Kernel;

abstract class AbstractSymfony
{
    /**
     *  return  true if symfony version more or equal 5.3.
     */
    public static function checkVersion(): bool
    {
        preg_match('/^(^\d+.\d+.)/', Kernel::VERSION, $output);
        if (\count($output)) {
            return (int)preg_replace('/[^0-9]/', '', $output[0]) >= 54;
        }

        return false;
    }
}
