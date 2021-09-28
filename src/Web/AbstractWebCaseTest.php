<?php

namespace Evrinoma\TestUtilsBundle\Web;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;

/**
 * AbstractWebCaseTest.
 */
abstract class AbstractWebCaseTest extends WebTestCase
{
//region SECTION: Fields
    protected static string $kernelPath = __DIR__.'/Kernel.php';
    /**
     * @var AbstractBrowser
     */
    protected $client;
    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $entityManager;
//endregion Fields

//region SECTION: Protected
    /**
     * {@inheritdoc}
     */
    protected static function createKernel(array $options = [])
    {
        require_once static::$kernelPath;

        return new Kernel('test', true);
    }

    protected function createAuthenticatedClient($token = null)
    {

        if (null === $this->client) {
            $this->client = static::createClient();
        }


        return $this->client;
    }

    protected function load(Fixture $fixture): void
    {
        $fixture->load($this->entityManager);
    }
//endregion Protected

//region SECTION: Public
    public function tearDown(): void
    {
        parent::tearDown();

        $purger = new ORMPurger($this->entityManager);
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $purger->purge();
    }
//endregion Public

//region SECTION: Getters/Setters
    public function setUp(): void
    {
        $this->client = $this->createAuthenticatedClient();

        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();

        $schemaTool = new SchemaTool($this->entityManager);
        $metadata   = $this->entityManager->getMetadataFactory()->getAllMetadata();

        $schemaTool->dropSchema($metadata);
        $schemaTool->createSchema($metadata);
    }
//endregion Getters/Setters

}