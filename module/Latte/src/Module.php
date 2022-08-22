<?php

declare(strict_types=1);

namespace Latte;

use Laminas\ModuleManager\ModuleManager;

final class Module
{
    /**
     * Register a specification for the ModelManager with the ServiceListener.
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
            'LatteManager',
            'latte_manager',
            'Latte\ModuleManager\Feature\LatteProviderInterface',
            'getLatteConfig'
        );
    }

    public function getConfig(): array
    {
        $configProvider = new ConfigProvider();
        return [
            'service_manager' => $configProvider->getDependencyConfig(),
            'view_manager'    => $configProvider->getViewConfig(),
            'latte_manager'   => $configProvider->getLatteConfig(),
        ];
    }
}
