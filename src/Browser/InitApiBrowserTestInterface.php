<?php

namespace Evrinoma\TestUtilsBundle\Browser;

use Symfony\Component\BrowserKit\AbstractBrowser;

interface InitApiBrowserTestInterface
{
//region SECTION: Getters/Setters
    /**
     * @param AbstractBrowser|null $client
     */
    public function setClient(?AbstractBrowser $client): void;

    public function setUrl(): void;
//endregion Getters/Setters
}