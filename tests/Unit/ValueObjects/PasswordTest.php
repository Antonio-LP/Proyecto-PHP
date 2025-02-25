<?php
use PHPUnit\Framework\TestCase;
use App\Domain\ValueObjects\Password;

class PasswordTest extends TestCase
{
    public function testValidPassword(): void
    {
        $password = new Password("Str0ng@Pass");
        $this->assertNotEmpty($password->getValue());
    }

    public function testWeakPasswordThrowsException(): void
    {
        $this->expectException(DomainException::class);
        new Password("weakpass");
    }
}
