<?php
use PHPUnit\Framework\TestCase;
use App\Domain\ValueObjects\Email;

class EmailTest extends TestCase
{
    public function testValidEmail(): void
    {
        $email = new Email("test@example.com");
        $this->assertEquals("test@example.com", $email->getValue());
    }

    public function testInvalidEmailThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Email("invalid-email");
    }
}
