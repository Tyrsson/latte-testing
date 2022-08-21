<?php

declare(strict_types=1);

namespace Latte\Renderer\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Latte\Renderer\LatteRenderer;
use Psr\Container\ContainerInterface;

class LatteRendererFactory implements FactoryInterface
{
    /** @param string $requestedName */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): LatteRenderer
    {
        return new $requestedName();
    }
}
