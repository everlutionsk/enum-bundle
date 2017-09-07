<?php

declare(strict_types=1);

namespace Everlution\EnumBundle\Exception;

use Exception;

/**
 * Class EnumNotMappedException.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
class EnumNotMappedException extends Exception
{
    public function __construct(string $enumClass, string $dbMap)
    {
        parent::__construct("Enum class $enumClass has not been mapped in $dbMap yet. Please map the enum type.");
    }
}
