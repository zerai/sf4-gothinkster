<?php

declare(strict_types=1);

namespace Identity\Infrastructure\Persistence\Doctrine\config\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Identity\Domain\Model\User\UserId;
use Ramsey\Uuid\Doctrine\UuidType;

class UserIdDoctrineType extends UuidType
{
    const NAME = 'user_id';

    public function convertToPHPValue($value, AbstractPlatform $platform): ?UserId
    {
        if (empty($value)) {
            return null;
        }
        if ($value instanceof UserId) {
            return $value;
        }
        try {
            return UserId::fromString($value);
        } catch (\Exception $ex) {
            throw ConversionException::conversionFailed($value, self::NAME);
        }
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;
        }
        if ($value instanceof UserId) {
            return $value->toString();
        }
        throw ConversionException::conversionFailed($value, self::NAME);
    }

    public function getName()
    {
        return self::NAME;
    }
}
