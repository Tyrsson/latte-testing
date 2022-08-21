<?php

declare(strict_types=1);

namespace Latte;

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
            ],
        ];
    }

    public function getViewConfig(): array
    {
        return [
            'strategies' => [
                Strategy\LatteRendererStrategy::class,
            ],
        ];
    }
}
