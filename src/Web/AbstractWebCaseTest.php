<?php

namespace Evrinoma\TestUtilsBundle\Web;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Evrinoma\TestUtilsBundle\Helper\AbstractSymfony;
use Symfony\Bridge\Doctrine\DataFixtures\ContainerAwareLoader;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;

/**
 * AbstractCaseTest.
 */
abstract class AbstractWebCaseTest extends WebTestCase
{

    /**
     * @var AbstractBrowser|null
     */
    protected ?AbstractBrowser $client = null;
    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $entityManager;


    protected function createAuthenticatedClient()
    {
        if ($this->client){
            return $this->client;
        }

        if (static::$booted) {
            $container = AbstractSymfony::checkVersion() ? $this->getContainer() : static::$container;;
            $this->client = $container->get('test.client');
        } else {
            $this->client = static::createClient();
        }

        return $this->client;
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->purgeSchema();
    }

    protected function setUp(): void
    {
        $this->client = $this->createAuthenticatedClient();

        $container = AbstractSymfony::checkVersion() ? $this->getContainer() : static::$container;;

        $this->entityManager = $container->get('doctrine')->getManager();

        $schemaTool = $this->dropSchema($metadata);

        $schemaTool->createSchema($metadata);

        $loader = $container->get('doctrine.fixtures.loader');

        $this->loadFixtures($loader);
    }


    private function loadFixtures(ContainerAwareLoader $loader): void
    {
        $groups = static::getFixtures();
        if (count($groups)) {
            $fixtures = $loader->getFixtures($groups);
            if (count($fixtures)) {
                $purger   = new ORMPurger($this->entityManager);
                $executor = new ORMExecutor($this->entityManager, $purger);
                $executor->execute($fixtures);
            }
        }
    }

    private function dropSchema(&$metadata = []): SchemaTool
    {
        $schemaTool = new SchemaTool($this->entityManager);
        $metadata   = $this->entityManager->getMetadataFactory()->getAllMetadata();

        $schemaTool->dropSchema($metadata);

        return $schemaTool;
    }

    private function purgeSchema()
    {
        $purger = new ORMPurger($this->entityManager);
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_DELETE);
        $purger->purge();
    }


    abstract public static function getFixtures(): array;

}
