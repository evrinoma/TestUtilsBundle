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

interface ApiMethodTestInterface
{
    public function postWrong(): array;

    public function post(array $query): array;

    public function delete(string $id): array;

    public function criteria(array $query): array;

    public function put(array $query): array;

    public function get(string $id): array;
}
