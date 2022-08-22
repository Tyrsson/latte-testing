<?php

declare(strict_types=1);

namespace Latte;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Latte\Engine;
use Latte\Loaders\FileLoader;
use Psr\Container\ContainerInterface;

class LatteEngineFactory implements FactoryInterface
{
    /** @param $requestedName */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): Engine
    {
        $engine = new Engine();
        $engine->setTempDirectory($container->get('config')['latte_manager']['latte_cache_path']);
        $engine->setLoader($container->get(FileLoader::class));
        return $engine;
    }
}
