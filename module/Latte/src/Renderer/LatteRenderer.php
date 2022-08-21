<?php

declare(strict_types=1);

namespace Latte\Renderer;

use Laminas\View\Renderer\RendererInterface;
use Laminas\View\Renderer\TreeRendererInterface;
use Laminas\View\Resolver\ResolverInterface;
use Latte\Engine;

class LatteRenderer implements RendererInterface, TreeRendererInterface
{
    /** @var Engine $engine */
    protected $engine;
    /**
     * Return the template engine object, if any
     *
     * If using a third-party template engine, such as Smarty, patTemplate,
     * phplib, etc, return the template engine object. Useful for calling
     * methods on these objects, such as for setting filters, modifiers, etc.
     *
     * @return mixed
     */
    public function getEngine()
    {
        if (! $this->engine instanceof Engine) {
            $this->engine = new Engine();
        }
        return $this->engine;
    }

    /**
     * Set the resolver used to map a template name to a resource the renderer may consume.
     *
     * @return RendererInterface
     */
    public function setResolver(ResolverInterface $resolver)
    {

    }

    public function canRenderTrees()
    {

    }

    /**
     * Processes a view script and returns the output.
     *
     * @param  string|ModelInterface   $nameOrModel The script/resource process, or a view model
     * @param  null|array|ArrayAccess $values      Values to use during rendering
     * @return string The script output.
     */
    public function render($nameOrModel, $values = null)
    {
        return $this->getEngine()->render($nameOrModel, $values);
    }
}
