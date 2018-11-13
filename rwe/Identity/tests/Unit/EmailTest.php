<?php

declare(strict_types=1);

namespace Identity\Tests\Unit;

use Identity\Domain\Model\User\Email;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    /** @test */
    public function it_creates_email_from_string()
    {
        $name = Email::fromString('foo');
        $this->assertInstanceOf(Email::class, $name);
        $this->assertNotEmpty($name->toString());
        $this->assertSame('foo', $name->toString());
    }
}
