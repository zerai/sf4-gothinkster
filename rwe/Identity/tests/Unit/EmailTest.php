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
        $email = Email::fromString('foo');

        $this->assertInstanceOf(Email::class, $email);
        $this->assertNotEmpty($email->toString());
        $this->assertSame('foo', $email->toString());
    }

    /** @test */
    public function it_can_be_compared()
    {
        self::markTestSkipped();
    }
}
