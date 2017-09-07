<?php

declare(strict_types=1);

namespace Everlution\EnumBundle;

use Serializable;

/**
 * Class Enum.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
interface EnumInterface extends Serializable
{
    /**
     * @return int
     */
    public function getValue(): int;

    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @return int[] ex.: ["label" => self::CONSTANT]
     */
    public static function getChoices(): array;
}
