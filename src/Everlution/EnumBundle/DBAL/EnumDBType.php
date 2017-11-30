<?php

declare(strict_types=1);

namespace Everlution\EnumBundle\DBAL;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Everlution\EnumBundle\EnumInterface;
use Everlution\EnumBundle\Exception\InvalidEnumValueException;

/**
 * Class EnumDBType.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
class EnumDBType extends Type
{
    const TYPE_ENUM = 'enum';

    /** @var string */
    private $enumClass;

    public function getName()
    {
        return self::TYPE_ENUM;
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        $platform->markDoctrineTypeCommented($this);

        return $platform->getVarcharTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * @param EnumInterface|null $value
     * @param AbstractPlatform $platform
     *
     * @return mixed
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        $enumClass = $this->getEnumClass();
        if ($value instanceof $enumClass === false) {
            return null;
        }

        return $value->getValue();
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     *
     * @return EnumInterface|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?EnumInterface
    {
        try {
            /** @var EnumInterface $enumClass */
            $enumClass = $this->getEnumClass();

            return new $enumClass($value);
        } catch (InvalidEnumValueException $e) {
            return null;
        }
    }

    /**
     * @return string
     */
    public function getEnumClass(): ?string
    {
        return $this->enumClass;
    }

    /**
     * @param string $enumClass
     *
     * @return EnumDBType
     */
    public function setEnumClass(?string $enumClass): EnumDBType
    {
        $this->enumClass = $enumClass;

        return $this;
    }
}
