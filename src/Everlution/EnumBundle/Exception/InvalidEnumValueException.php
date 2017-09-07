<?php

declare(strict_types=1);

namespace Everlution\EnumBundle\Exception;

use Exception;

/**
 * Class InvalidValueException.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
class InvalidEnumValueException extends Exception
{
    public function __construct(string $className, $enteredValue, array $validValues)
    {
        $availableValues = join(', ', $validValues);
        parent::__construct(
            "Invalid $className enum value '$enteredValue'. Available values are: [$availableValues]"
        );
    }
}
