<?php

declare(strict_types=1);

namespace Everlution\EnumBundle\DependencyInjection;

use Doctrine\Bundle\DoctrineBundle\ConnectionFactory as DoctrineConnectionFactory;
use Doctrine\Common\EventManager;
use Doctrine\DBAL\Configuration;
use Everlution\EnumBundle\DBAL\EnumDBMapInterface;

/**
 * Class ConnectionFactory.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
class ConnectionFactory extends DoctrineConnectionFactory
{
    use EnumMappingTrait;

    /** @var EnumDBMapInterface */
    private $enumDBMap;

    public function __construct(array $typesConfig, EnumDBMapInterface $enumDBMap)
    {
        $this->enumDBMap = $enumDBMap;
        parent::__construct($typesConfig);
    }

    public function createConnection(
        array $params,
        Configuration $config = null,
        EventManager $eventManager = null,
        array $mappingTypes = []
    ) {
        $this->enumMapping($this->enumDBMap);
        return parent::createConnection($params, $config, $eventManager, $mappingTypes);
    }
}
