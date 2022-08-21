<?php

declare(strict_types=1);

namespace Latte\Strategy\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Latte\Renderer\LatteRenderer;
use Latte\Strategy\LatteRendererStrategy;
use Psr\Container\ContainerInterface;

class LatteRendererStrategyFactory implements FactoryInterface
{
    /** @param string $requestedName */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        ?array $options = null
    ): LatteRendererStrategy {
        return new $requestedName($container->get(LatteRenderer::class));
    }
}
