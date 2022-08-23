<?php

declare(strict_types=1);

namespace Latte;

use Latte\Engine;
use Latte\Loaders\FileLoader;

class ConfigProvider
{
    public function __invoke(): array
    {
        return ['dependencies' => $this->getDependencyConfig()];
    }

    public function getDependencyConfig(): array
    {
        return [
            'aliases'   => [],
            'factories' => [
                Renderer\LatteRenderer::class         => Renderer\Factory\LatteRendererFactory::class,
                Strategy\LatteRendererStrategy::class => Strategy\Factory\LatteRendererStrategyFactory::class,
                Engine::class                         => LatteEngineFactory::class,
                FileLoader::class                     => LatteLoaderFactory::class,
            ],
        ];
    }

    /** This method will/can be used by other modules to push extensions into the pluginmanager */
    public function getLatteConfig(): array
    {
        return [
            'latte_cache_path'    => __DIR__ . '/../../../data/latte',
            'latte_template_path' => __DIR__ . '/../../../module/Application/view',
            'template_ext'        => '.latte',
            //'extensions'          => [],
        ];
    }
}
