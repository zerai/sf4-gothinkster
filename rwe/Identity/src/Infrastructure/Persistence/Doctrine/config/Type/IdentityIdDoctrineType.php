<?php

declare(strict_types=1);

namespace Identity\Infrastructure\Persistence\Doctrine\config\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Identity\Domain\Model\Identity\IdentityId;
use Ramsey\Uuid\Doctrine\UuidType;

class IdentityIdDoctrineType extends UuidType
{
    const NAME = 'identity_id';

    public function convertToPHPValue($value, AbstractPlatform $platform): ?IdentityId
    {
        if (empty($value)) {
            return null;
        }
        if ($value instanceof IdentityId) {
            return $value;
        }
        try {
            return IdentityId::fromString($value);
        } catch (\Exception $ex) {
            throw ConversionException::conversionFailed($value, self::NAME);
        }
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;
        }
        if ($value instanceof IdentityId) {
            return $value->toString();
        }
        throw ConversionException::conversionFailed($value, self::NAME);
    }

    public function getName()
    {
        return self::NAME;
    }
}
