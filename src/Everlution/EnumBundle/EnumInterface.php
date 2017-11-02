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
     * @return mixed
     */
    public function getValue();

    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @return mixed[] ex.: ["label" => self::CONSTANT]
     */
    public static function getChoices(): array;
}
