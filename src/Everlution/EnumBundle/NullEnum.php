<?php

namespace Everlution\EnumBundle;

/**
 * Class NullEnum.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
final class NullEnum extends Enum
{
    public static function getChoices(): array
    {
        return [];
    }
}
