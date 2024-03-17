<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

/**
 * @var ContainerBuilder $containerBuilder
 */

//$containerBuilder = new ContainerBuilder();
$fileLocator = new FileLocator(__DIR__);
$loader = new PhpFileLoader($containerBuilder, $fileLocator);

$loader->load(__DIR__ . '/../../../../../../vendor/untek-framework/http/src/Resources/config/services/routing.php');
$loader->load(__DIR__ . '/services/rest-api.php');

return $containerBuilder;
