<?php

declare(strict_types=1);

namespace Latte\Strategy;

use Laminas\EventManager\AbstractListenerAggregate;
use Laminas\EventManager\EventManagerInterface;
use Laminas\View\ViewEvent;
use Latte\Model\LatteModel;
use Latte\Renderer\LatteRenderer;

class LatteRendererStrategy extends AbstractListenerAggregate
{
    /** @var LatteRenderer $renderer */
    protected $renderer;

    public function __construct(LatteRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, [$this, 'selectRenderer'], $priority);
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, [$this, 'injectResponse'], $priority);
    }

    /**
     * Retrieve the composed renderer
     */
    public function getRenderer(): LatteRenderer
    {
        return $this->renderer;
    }

    /**
     * By checking the type here, we can allow the default PhpRenderer to handle it
     * if we simply return
     */
    public function selectRenderer(ViewEvent $e)
    {
        $model = $e->getModel();
        if (! $model instanceof LatteModel) {
            return;
        }
        return $this->renderer;
    }

    /**
     * Populate the response object from the View
     *
     * Populates the content of the response object from the view rendering
     * results.
     *
     * @return void
     */
    public function injectResponse(ViewEvent $e)
    {
        $renderer = $e->getRenderer();
        $response = $e->getResponse();
        if ($renderer !== $this->renderer || $response === null) {
            return;
        }

        $result = $e->getResult();

        $response->setContent($result);
    }
}
