<?php

namespace Evrinoma\TestUtilsBundle\Controller;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Evrinoma\ContractorBundle\Fixtures\ContractorFixtures;
use Evrinoma\ContractorBundle\Tests\Functional\CaseTest;

abstract class AbstractControllerTest extends CaseTest
{
//region SECTION: Fields
    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $entityManager;
//endregion Fields

//region SECTION: Protected
    protected function loadContractorFixtures(): void
    {
        $this->load(new ContractorFixtures());
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

//region SECTION: Private
    private function load(Fixture $fixture): void
    {
        $fixture->load($this->entityManager);
    }
//endregion Private

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
