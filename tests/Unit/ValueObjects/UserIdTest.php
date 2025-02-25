<?php
use PHPUnit\Framework\TestCase;
use App\Domain\ValueObjects\UserId;

class UserIdTest extends TestCase
{
    public function testGenerateNewUserId(): void
    {
        $userId = new UserId();
        $this->assertNotEmpty($userId->getValue());
        $this->assertEquals(32, strlen($userId->getValue()));
    }

    public function testValidUserId(): void
    {
        $customId = bin2hex(random_bytes(16));
        $userId = new UserId($customId);

        $this->assertEquals($customId, $userId->getValue());
    }

    public function testToStringMethod(): void
    {
        $userId = new UserId();
        $this->assertEquals($userId->getValue(), (string) $userId);
    }
}
