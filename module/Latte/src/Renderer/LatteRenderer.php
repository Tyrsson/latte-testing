<?php

declare(strict_types=1);

namespace Latte\Renderer;

use Laminas\View\Renderer\PhpRenderer;
use Latte\Engine;

class LatteRenderer extends PhpRenderer
{
    /** @var array<mixed> $config */
    protected $config;
    /** @var Engine $engine */
    protected $engine;
    /** @var string $extension */
    protected $extension;

    public function __construct(Engine $engine, array $config)
    {
        $this->config    = $config;
        $this->engine    = $engine;
        $this->extension = $this->config['latte_manager']['template_ext'] ?? '.phtml';
    }

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
     * Processes a view script and returns the output.
     *
     * @param  string|ModelInterface   $nameOrModel The script/resource process, or a view model
     * @param  null|array|ArrayAccess $values      Values to use during rendering
     * @return string The script output.
     */
    public function render($nameOrModel, $values = null)
    {
        return $this->getEngine()->render(
            $nameOrModel->getTemplate() . $this->extension,
            $nameOrModel->getVariables()
        );
    }
}
