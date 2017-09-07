<?php

namespace Example;

use Everlution\EnumBundle\DBAL\EnumDBMapInterface;

/**
 * Class EnumDBMap.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
class EnumDBMap implements EnumDBMapInterface
{
    public function getMap(): array
    {
        return [
            'enum_gender' => Gender::class,
        ];
    }
}
