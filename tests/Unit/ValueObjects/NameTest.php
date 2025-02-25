<?php 
use PHPUnit\Framework\TestCase;
use App\Domain\ValueObjects\Name;

class NameTest extends TestCase
{
    public function testValidName(): void
    {
        $name = new Name("John Doe");
        $this->assertEquals("John Doe", $name->getValue());
    }

    public function testShortNameThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Name("J");
    }

    public function testInvalidCharactersThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Name("John123!");
    }
}