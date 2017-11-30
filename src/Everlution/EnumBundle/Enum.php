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
    /** @var mixed */
    protected $value;

    /**
     * Enum constructor.
     *
     * @param mixed $value constant
     *
     * @throws InvalidEnumValueException
     */
    public function __construct($value)
    {
        if (in_array($value, $this->getChoices()) === false) {
            throw new InvalidEnumValueException(static::class, $value, $this->getChoices());
        }
        $this->value = $value;
    }

    /**
     * @return mixed[] ex.: ['label' => self::CONSTANT]
     */
    abstract public static function getChoices(): array;

    /**
     * @return mixed
     */
    final public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    final public function isValue($value): bool
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
     * @return mixed
     */
    final public function serialize()
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
