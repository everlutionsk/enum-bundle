<?php

declare(strict_types=1);

namespace Everlution\EnumBundle\DBAL;

/**
 * Class EnumDBMap.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
interface EnumDBMapInterface
{
    public function getMap(): array;
}
