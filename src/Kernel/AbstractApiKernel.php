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

namespace Evrinoma\TestUtilsBundle\Kernel;

use Psr\Log\NullLogger;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Kernel.
 */
abstract class AbstractApiKernel extends Kernel
{
    protected string $rootDir = __DIR__;
    protected string $bundlePrefix = '';
    private array    $bundleConfig = ['doctrine.yaml', 'fos_rest.yaml', 'framework.yaml', 'jms_serializer.yaml'];
    private ?string  $cacheDir = null;
    private ?string  $logDir = null;

    protected function build(ContainerBuilder $container)
    {
        $container->register('logger', NullLogger::class);

        if (!$container->hasParameter('kernel.root_dir')) {
            $container->setParameter('kernel.root_dir', $this->getRootDir());
        }
    }

    abstract protected function getBundleConfig(): array;

    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        return [
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new \Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new \Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new \FOS\RestBundle\FOSRestBundle(),
            new \Nelmio\ApiDocBundle\NelmioApiDocBundle(),
            new \JMS\SerializerBundle\JMSSerializerBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $this->load($loader, new FileLocator(__DIR__.'/../Resources/config'), $this->bundleConfig);
        $this->load($loader, new FileLocator($this->getRootDir().'/Resources/config'), $this->getBundleConfig());
    }

    private function load(LoaderInterface $loader, FileLocator $locator, array $listName)
    {
        foreach ($listName as $fileConfig) {
            $loader->load($locator->locate($fileConfig));
        }
    }

    private function getRootDir(): string
    {
        return $this->rootDir;
    }

    private function getBundlePrefix(): string
    {
        return $this->bundlePrefix;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        if (null === $this->cacheDir) {
            $this->cacheDir = sys_get_temp_dir().'/'.$this->getBundlePrefix().'/cache';
        }

        return $this->cacheDir;
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        if (null === $this->logDir) {
            $this->logDir = sys_get_temp_dir().'/'.$this->getBundlePrefix().'/logs';
        }

        return $this->logDir;
    }
}
