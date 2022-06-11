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

namespace Evrinoma\TestUtilsBundle\Browser;

use Symfony\Component\BrowserKit\AbstractBrowser;

interface InitApiBrowserTestInterface
{
    /**
     * @param AbstractBrowser|null $client
     */
    public function setClient(?AbstractBrowser $client): void;

    public function setUrl(): void;
}
