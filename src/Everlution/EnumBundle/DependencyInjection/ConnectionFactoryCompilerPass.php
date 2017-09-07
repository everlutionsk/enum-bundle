<?php

declare(strict_types=1);

namespace Everlution\EnumBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class ConnectionFactoryCompilerPass.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
class ConnectionFactoryCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('enum.db_map') == false) {
            throw new \Exception("Please create new service called 'enum.db_map' that implements EnumDBMapInterface");
        }
        $definition = $container->getDefinition('doctrine.dbal.connection_factory');
        $definition->setClass(ConnectionFactory::class);
        $definition->addArgument($container->getDefinition('enum.db_map'));
    }
}
