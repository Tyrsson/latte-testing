<?php

declare(strict_types=1);

namespace Latte\ModuleManager\Feature;

use Laminas\ServiceManager\Config;

interface LatteProviderInterface
{
    /**
     * Expected to return \Laminas\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|Config
     */
    public function getLatteConfig();
}
