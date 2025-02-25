<?php
use PHPUnit\Framework\TestCase;
use App\Domain\Entities\User;
use App\Domain\ValueObjects\UserId;
use App\Domain\ValueObjects\Name;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Password;

class UserTest extends TestCase
{
    public function testCreateUserSuccessfully(): void
    {
        $user = new User(
            new UserId(),
            new Name("John Doe"),
            new Email("johndoe@example.com"),
            new Password("StrongP@ss1")
        );

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals("John Doe", $user->getName());
        $this->assertEquals("johndoe@example.com", $user->getEmail());
    }
}
