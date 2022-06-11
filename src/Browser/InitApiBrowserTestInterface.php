<?php

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