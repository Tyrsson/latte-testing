<?php

namespace Latte\Strategy;

use Laminas\EventManager\AbstractListenerAggregate;
use Laminas\EventManager\EventManagerInterface;
use Laminas\View\ViewEvent;
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
     * Select the PhpRenderer; typically, this will be registered last or at
     * low priority.
     */
    public function selectRenderer(ViewEvent $e): LatteRenderer
    {
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

        // Set content
        // If content is empty, check common placeholders to determine if they are
        // populated, and set the content from them.
        // if (empty($result)) {
        //     $placeholders = $renderer->plugin('placeholder');
        //     foreach ($this->contentPlaceholders as $placeholder) {
        //         if ($placeholders->containerExists($placeholder)) {
        //             $result = (string) $placeholders->getContainer($placeholder);
        //             break;
        //         }
        //     }
        // }
        $response->setContent($result);
    }
}
