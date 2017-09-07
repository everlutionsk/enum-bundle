<?php

declare(strict_types=1);

namespace Everlution\EnumBundle\Exception;

use Exception;

/**
 * Class InvalidClassException.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
class InvalidClassException extends Exception
{
    public function __construct(string $expected = null, string $got = null)
    {
        $message = 'Invalid class passed as argument';
        if ($expected !== null) {
            $message .= ", expected '$expected'";
        }
        if ($got !== null) {
            $message .= ", got '$got'";
        }
        parent::__construct($message);
    }
}
