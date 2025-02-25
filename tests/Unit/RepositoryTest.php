<?php
use PHPUnit\Framework\TestCase;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use App\Infrastructure\Persistence\DoctrineUserRepository;
use App\Domain\Entities\User;
use App\Domain\ValueObjects\UserId;
use App\Domain\ValueObjects\Name;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Password;

class DoctrineUserRepositoryTest extends TestCase
{
    private EntityManager $entityManager;
    private DoctrineUserRepository $repository;

    protected function setUp(): void
    {
        $this->entityManager =  require __DIR__ . '/../../config/doctrine.php';
        $schemaTool = new SchemaTool($this->entityManager);
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();

        $schemaTool->dropSchema($metadata);
        $schemaTool->createSchema($metadata);


        $this->repository =   DoctrineUserRepository::getInstance($this->entityManager);
    }

    public function testSaveAndFindUser(): void
    {
        $user = new User(
            new UserId(),
            new Name("Jane Doe"),
            new Email("janedoe@example.com"),
            new Password("StrongP@ss1")
        );

        $this->repository->save($user);

        $retrievedUser = $this->repository->findById($user->getId());

        $this->assertNotNull($retrievedUser);
        $this->assertEquals("janedoe@example.com", $retrievedUser->getEmail());
    }

    public function testDeleteUser(): void
    {
        $user = new User(
            new UserId(),
            new Name("Mark Smith"),
            new Email("marksmith@example.com"),
            new Password("Str0ngP@ss1")
        );

        $this->repository->save($user);
        $this->repository->delete($user->getId());

        $this->assertNull($this->repository->findById($user->getId()));
    }
}
