<?php
namespace App\Infrastructure\Persistence;

use Doctrine\ORM\EntityManagerInterface;
use App\Domain\Interfaces\UserRepositoryInterface;
use App\Domain\Entities\User;
use App\Domain\ValueObjects\UserId;
use App\Domain\ValueObjects\Email;
use Doctrine\ORM\EntityRepository;

class DoctrineUserRepository extends EntityRepository implements UserRepositoryInterface {
    private static ?DoctrineUserRepository $instance = null;
    private static ?EntityManagerInterface $entityManager = null;

    private function __construct(EntityManagerInterface $em) {
        parent::__construct($em, $em->getClassMetadata(User::class));
        self::$entityManager = $em;
    }

    // Método para obtener la instancia única
    public static function getInstance(EntityManagerInterface $em = null): DoctrineUserRepository {
        if (self::$instance === null) {
            self::$instance = new self($em);
        }
        return self::$instance;
    }

    public function save(User $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function findById(UserId $id): ?User
    {
        return $this->find($id);
    }

    public function findByEmail(Email $email): ?User
    {
        $query = $this->findOneBy(['email.value' => $email->getValue()]);
        return $query;
    }

    public function delete(UserId $id): void
    {
        $user = $this->findById($id);
        if ($user) {
            $this->getEntityManager()->remove($user);
            $this->getEntityManager()->flush();
        }
    }
}
