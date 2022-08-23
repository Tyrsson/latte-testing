<?php

declare(strict_types=1);

namespace Latte;

use Laminas\ModuleManager\ModuleManager;
use Laminas\Mvc\MvcEvent;
use Laminas\View\View;

final class Module
{
    /**
     * Register a specification for the LatteManager with the ServiceListener.
     *
     * @param ModuleManager $moduleManager
     * @return void
     */
    public function init($moduleManager)
    {
        $event           = $moduleManager->getEvent();
        $container       = $event->getParam('ServiceManager');
        $serviceListener = $container->get('ServiceListener');

        $serviceListener->addServiceManager(
            'LatteManager', // not sure were going to use this
            'latte_manager', // this is being used
            'Latte\ModuleManager\Feature\LatteProviderInterface', // can be used by other modules to add extensions
            'getLatteConfig' // this is the method the Module.php file would need to implement or use the 'extensions' config key
        );
    }

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        /**
         * By wiring the Strategy this way, we get to use both
         * the default PhpRenderer and the LatteRenderer side by side
         * what determines which strategy will be is based on what type
         * of Model is returned from the controller action
         * see IndexController for example usage
         */
        $eventManager->attach(MvcEvent::EVENT_RENDER, [$this, 'registerLatteStrategy'], 100);
    }

    public function registerLatteStrategy(MvcEvent $e)
    {
        $container     = $e->getApplication()->getServicemanager();
        $view          = $container->get(View::class);
        $latteStrategy = $container->get(Strategy\LatteRendererStrategy::class);
        $latteStrategy->attach($view->getEventManager(), 100);
    }

    public function getConfig(): array
    {
        $configProvider = new ConfigProvider();
        return [
            'service_manager' => $configProvider->getDependencyConfig(),
            'latte_manager'   => $configProvider->getLatteConfig(),
        ];
    }
}
