<?php

namespace Evrinoma\TestUtilsBundle\Kernel;

use Psr\Log\NullLogger;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Kernel
 */
abstract class AbstractApiKernel extends Kernel
{
//region SECTION: Fields
    protected string $rootDir      = __DIR__;
    protected string $bundlePrefix = '';
    private ?string  $cacheDir     = null;
    private ?string  $logDir       = null;
//endregion Fields

//region SECTION: Protected
    protected function build(ContainerBuilder $container)
    {
        $container->register('logger', NullLogger::class);

        if (!$container->hasParameter('kernel.root_dir')) {
            $container->setParameter('kernel.root_dir', $this->getRootDir());
        }
    }
//endregion Protected

//region SECTION: Public
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        return [
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new \Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new \FOS\RestBundle\FOSRestBundle(),
            new \Nelmio\ApiDocBundle\NelmioApiDocBundle(),
            new \JMS\SerializerBundle\JMSSerializerBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config.yml');
    }
//endregion Public

//region SECTION: Private
    private function getRootDir(): string
    {
        return $this->rootDir;
    }

    private function getBundlePrefix(): string
    {
        return $this->bundlePrefix;
    }
//endregion Private

//region SECTION: Getters/Setters
    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        if ($this->cacheDir === null) {
            $this->cacheDir = sys_get_temp_dir().'/'.$this->getBundlePrefix().'/cache';
        }

        return $this->cacheDir;
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        if ($this->logDir === null) {
            $this->logDir = sys_get_temp_dir().'/'.$this->getBundlePrefix().'/logs';
        }

        return $this->logDir;
    }
//endregion Getters/Setters
}
