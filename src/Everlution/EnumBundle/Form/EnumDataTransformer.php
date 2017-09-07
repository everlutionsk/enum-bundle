<?php

declare(strict_types=1);

namespace Everlution\EnumBundle\Form;

use Everlution\EnumBundle\EnumInterface;
use Everlution\EnumBundle\Exception\InvalidClassException;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class EnumDataTransformer.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
class EnumDataTransformer implements DataTransformerInterface
{
    /** @var string */
    private $enumClassName;

    /**
     * EnumDataTransformer constructor.
     *
     * @param string $className
     *
     * @throws InvalidClassException
     */
    public function __construct(string $className)
    {
        if (in_array(EnumInterface::class, class_implements($className)) === false) {
            throw new InvalidClassException(EnumInterface::class);
        }
        $this->enumClassName = $className;
    }

    /**
     * @param mixed $value
     *
     * @return int|null
     */
    public function transform($value)
    {
        if ($value instanceof EnumInterface === false) {
            return '';
        }

        return (string) $value->getValue();
    }

    /**
     * @param mixed $value
     *
     * @return EnumInterface
     */
    public function reverseTransform($value): ?EnumInterface
    {
        if (is_numeric($value) === false) {
            return null;
        }

        return new $this->enumClassName((int) $value);
    }
}
