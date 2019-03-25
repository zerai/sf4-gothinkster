<?php

declare(strict_types=1);

namespace Member\Tests\Unit;

use Member\Domain\Model\User\UserId;
use Member\Domain\Model\User\UserRelation;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class UserRelationTest extends TestCase
{
    /** @test */
    public function it_can_create(): void
    {
        $userId = UserId::generate();

        $user = new UserRelation($userId);

        $this->assertInstanceOf(UserRelation::class, $user);
        $this->assertEmpty($user->followers());
        $this->assertEmpty($user->following());
    }

    /** @test */
    public function it_can_add_following_user(): void
    {
        $userId = UserId::generate();
        $followingUserId = UserId::generate();
        $otherFollowingUserId = UserId::generate();

        $user = new UserRelation($userId);
        $user->addFollowingUser($followingUserId);
        $user->addFollowingUser($otherFollowingUserId);

        $this->assertNotEmpty($user->following());
        $this->assertCount(2, $user->following());
        $this->assertContains($followingUserId->toString(), $user->following());
        $this->assertContains($otherFollowingUserId->toString(), $user->following());
    }

    /** @test */
    public function it_can_remove_following_user(): void
    {
        $userId = UserId::generate();
        $followingUserId = UserId::generate();
        $user = new UserRelation($userId);
        $user->addFollowingUser($followingUserId);

        $user->removeFollowingUser($followingUserId);

        $this->assertEmpty($user->following());
        $this->assertCount(0, $user->following());
    }

    /** @test */
    public function it_can_be_compared(): void
    {
        $stringId = UUID::uuid4()->toString();
        $userRelationOne = new UserRelation(UserId::fromString($stringId));
        $userRelationTwo = new UserRelation(UserId::fromString($stringId));
        $otherUserRelation = new UserRelation(UserId::generate());

        $this->assertTrue($userRelationOne->sameIdentityAs($userRelationTwo));
        $this->assertTrue($userRelationTwo->sameIdentityAs($userRelationOne));
        $this->assertFalse($userRelationOne->sameIdentityAs($otherUserRelation));
        $this->assertFalse($otherUserRelation->sameIdentityAs($userRelationTwo));
    }

    public function it_protect_from_self_following(): void
    {
        $stringId = UUID::uuid4()->toString();
        $userRelation = new UserRelation(UserId::fromString($stringId));
        $followingUserId = UserId::fromString($stringId);

        $userRelation->addFollowingUser($followingUserId);

        $this->assertCount(0, $userRelation->following());
    }

    public function it_protect_from_double_following(): void
    {
        $stringId = UUID::uuid4()->toString();
        $userRelation = new UserRelation(UserId::generate());
        $followingUserId = UserId::fromString($stringId);
        $doublefollowingUserId = UserId::fromString($stringId);

        $userRelation->addFollowingUser($followingUserId);
        $userRelation->addFollowingUser($doublefollowingUserId);

        $this->assertCount(1, $userRelation->following());
    }
}
