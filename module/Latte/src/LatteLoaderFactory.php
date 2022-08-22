<?php

declare(strict_types=1);

namespace Latte;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Latte\Loaders\FileLoader;
use Psr\Container\ContainerInterface;

class LatteLoaderFactory implements FactoryInterface
{
    /** @param $requestedName */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): FileLoader
    {
        // Here $requestedName is FileLoader::class
        return new $requestedName($container->get('config')['latte_manager']['latte_template_path']);
    }
}
