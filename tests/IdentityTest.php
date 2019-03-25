<?php

declare(strict_types=1);

namespace App\Tests;

use Identity\Domain\Model\Identity\Email;
use Identity\Domain\Model\Identity\HashPassword;
use Identity\Domain\Model\Identity\Identity;
use Identity\Domain\Model\Identity\IdentityId;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class IdentityTest extends TestCase
{

    public function testEmail()
    {
        self::markTestSkipped();
    }

    public function testIdentityId()
    {
        self::markTestSkipped();
    }

    public function testAssignNewHashPassword()
    {
        self::markTestSkipped();
    }

    public function test__construct()
    {
        $identity = new Identity(IdentityId::generate(),Email::fromString('pippo@example.com'),HashPassword::fromString('xxx'));

        self::assertInstanceOf(Identity::class, $identity);
    }

    public function testHashPassword()
    {
        self::markTestSkipped();
    }

    public function testSameIdentityAs()
    {
        self::markTestSkipped();
    }
}
