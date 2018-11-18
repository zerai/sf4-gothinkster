<?php

declare(strict_types=1);

namespace Identity\Infrastructure\Persistence\Doctrine\config\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\StringType;
use Identity\Domain\Model\User\FirstName;

class FirstNameDoctrineType extends StringType
{
    const NAME = 'first_name';

    public function convertToPHPValue($value, AbstractPlatform $platform): ?FirstName
    {
        if (empty($value)) {
            return null;
        }
        if ($value instanceof FirstName) {
            return $value;
        }
        try {
            return FirstName::fromString($value);
        } catch (\Exception $ex) {
            throw ConversionException::conversionFailed($value, self::NAME);
        }
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;
        }
        if ($value instanceof FirstName) {
            return $value->toString();
        }
        throw ConversionException::conversionFailed($value, self::NAME);
    }

    public function getName()
    {
        return self::NAME;
    }
}
