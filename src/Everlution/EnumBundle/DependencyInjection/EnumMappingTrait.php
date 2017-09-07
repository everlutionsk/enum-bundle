<?php

namespace Everlution\EnumBundle\DependencyInjection;

use Doctrine\DBAL\Types\Type;
use Everlution\EnumBundle\DBAL\EnumDBMapInterface;
use Everlution\EnumBundle\DBAL\EnumDBType;
use Everlution\EnumBundle\NullEnum;

/**
 * Class EnumMappingTrait.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
trait EnumMappingTrait
{
    protected function enumMapping(EnumDBMapInterface $enumDBMap)
    {
        $map = $enumDBMap->getMap();

        // this line fixes a quite mysterious error
        // TODO try removing it and update schema without getting an error
        $map['enum'] = NullEnum::class;

        foreach ($map as $enumName => $enumClass) {
            Type::addType($enumName, EnumDBType::class);
            /** @var EnumDBType $type */
            $type = Type::getType($enumName);
            $type->setEnumClass($enumClass);
        }
    }
}
