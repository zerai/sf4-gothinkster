<?php

declare(strict_types=1);

namespace Identity\Tests\Unit;

use Identity\Domain\Model\Identity\IdentityId;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class IdentityIdTest extends TestCase
{
    /** @test */
    public function it_can_autogenerate_a_identityId()
    {
        $identityId = IdentityId::generate();

        $this->assertInstanceOf(IdentityId::class, $identityId);
    }

    /** @test */
    public function it_can_generate_a_identityId_from_string()
    {
        $uuid = Uuid::uuid4();

        $identityId = IdentityId::fromString($uuid->toString());

        $this->assertEquals($uuid->toString(), $identityId->toString());
    }

    /** @test */
    public function it_can_be_compared()
    {
        self::markTestSkipped();
    }
}
