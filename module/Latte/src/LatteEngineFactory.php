<?php

declare(strict_types=1);

namespace Latte;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Latte\Engine;
use Latte\Loaders\FileLoader;
use Psr\Container\ContainerInterface;

use function class_exists;

class LatteEngineFactory implements FactoryInterface
{
    /** @param $requestedName */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): Engine
    {
        $engine = new Engine();
        $latteConfig = $container->get('config')['latte_manager'];
        $engine->setTempDirectory($latteConfig['latte_cache_path']);
        $engine->setLoader($container->get(FileLoader::class));
        if (isset($latteConfig['extensions'])) {
            foreach ($latteConfig['extensions'] as $ext) {
                if (class_exists($ext)) {
                    $engine->addExtension(new $ext());
                }
            }
        }
        return $engine;
    }
}
