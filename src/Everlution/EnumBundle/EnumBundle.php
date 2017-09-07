<?php

namespace Everlution\EnumBundle;

use Everlution\EnumBundle\DependencyInjection\ConnectionFactoryCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class EnumBundle.
 *
 * @author Richard Popelis <richard@popelis.sk>
 */
class EnumBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new ConnectionFactoryCompilerPass());
    }
}
