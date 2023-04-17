<?php

namespace Untek\Framework\RestApi\Infrastructure;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Untek\Core\Kernel\Bundle\BaseBundle;

class RestApiFrameworkBundle extends BaseBundle
{
    public function getName(): string
    {
        return 'rest-api-framework';
    }

    public function build(ContainerBuilder $containerBuilder)
    {
        $this->importServices($containerBuilder, __DIR__ . '/DependencyInjection/Symfony/services/rest-api.php');
        $this->importServices($containerBuilder, __DIR__ . '/../../../../../vendor/untek-framework/http/src/Infrastructure/DependencyInjection/Symfony/services/routing.php');
    }
}
