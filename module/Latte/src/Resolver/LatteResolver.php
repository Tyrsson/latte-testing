<?php

declare(strict_types=1);

namespace Latte\Resolver;

use Laminas\View\Renderer\RendererInterface;
use Laminas\View\Resolver\ResolverInterface;
use Latte\Loaders\FileLoader;
use Latte\Loaders\StringLoader;

class LatteResolver implements ResolverInterface
{
    /** @var array<mixed> $config */
    protected $config;
    /** @var FileLoader $fileLoader */
    protected $fileLoader;
    /** @var StringLoader $stringLoader */
    protected $stringLoader;
    public function __construct(FileLoader $fileLoader, StringLoader $stringLoader, array $config)
    {
        $this->config       = $config;
        $this->fileLoader   = $fileLoader;
        $this->stringLoader = $stringLoader;
    }

    /** @inheritDoc */
    public function resolve($name, ?RendererInterface $renderer = null)
    {

    }
}
