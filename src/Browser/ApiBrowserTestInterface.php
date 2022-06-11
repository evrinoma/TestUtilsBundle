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

interface ApiBrowserTestInterface
{
    public function queryPost(array $query): array;

    public function queryDelete(array $query): array;

    public function queryPut(array $query): array;

    public function queryGet(array $query): array;

    public function queryCriteria(array $query): array;

    public function toResponse(): array;
}
