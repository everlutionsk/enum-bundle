<?php

declare(strict_types=1);

namespace Everlution\EnumBundle\Exception;

use Exception;


/**
 * Class InvalidEnumKeyException.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
class InvalidEnumKeyException extends Exception
{
    public function __construct($key, string $enumMapClass)
    {
        parent::__construct(
            "Invalid enum key '$key' stored in database. ".
            "This might have happened because you incorrectly changed the enum map ($enumMapClass).\n".
            'Please leave the same keys to the same enum classes.'
        );
    }
}
