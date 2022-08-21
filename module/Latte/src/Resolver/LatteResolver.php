<?php

declare(strict_types=1);

namespace Latte\Resolver;

use Laminas\View\Renderer\RendererInterface;
use Laminas\View\Resolver\ResolverInterface;

class LatteResolver implements ResolverInterface
{
    /** @inheritDoc */
    public function resolve($name, ?RendererInterface $renderer = null)
    {
    }
}
