<?php

declare(strict_types=1);

namespace Everlution\EnumBundle;

use Everlution\EnumBundle\Exception\InvalidEnumValueException;

/**
 * Class Enum.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
abstract class Enum implements EnumInterface
{
    /** @var int */
    protected $value;

    /**
     * Enum constructor.
     *
     * @param int $value constant
     *
     * @throws InvalidEnumValueException
     */
    public function __construct(int $value)
    {
        if (in_array($value, $this->getChoices()) === false) {
            throw new InvalidEnumValueException(static::class, $value, $this->getChoices());
        }
        $this->value = $value;
    }

    /**
     * @return int[] ex.: ['label' => self::CONSTANT]
     */
    abstract public static function getChoices(): array;

    /**
     * @return int
     */
    final public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return bool
     */
    final public function isValue(int $value): bool
    {
        return $this->value === $value;
    }

    /**
     * @param EnumInterface $enum
     * @return bool
     */
    final public function isSameAs(EnumInterface $enum): bool
    {
        return $this->isValue($enum->getValue()) && (get_class($this) == get_class($enum));
    }

    /**
     * @return string
     */
    final public function getLabel(): string
    {
        return (string)array_search($this->value, $this->getChoices());
    }

    /**
     * @return int
     */
    final public function serialize(): int
    {
        return $this->getValue();
    }

    /**
     * @param mixed $serialized
     *
     * @return EnumInterface
     */
    final public function unserialize($serialized): EnumInterface
    {
        static::__construct($serialized);
        
        return $this;
    }

    /**
     * @return string label representation
     */
    public function __toString(): string
    {
        return $this->getLabel();
    }
}
