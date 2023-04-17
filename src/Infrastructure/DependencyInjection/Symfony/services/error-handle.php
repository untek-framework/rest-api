<?php

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Untek\Framework\RestApi\Presentation\Http\Symfony\Controllers\RestApiErrorController;
use Untek\Framework\RestApi\Presentation\Http\Symfony\Subscribers\RestApiHandleSubscriber;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services();

    $services->set(RestApiErrorController::class, RestApiErrorController::class)
        ->args(
            [
                service(LoggerInterface::class)
            ]
        );
    $services->set(RestApiHandleSubscriber::class, RestApiHandleSubscriber::class)
        ->args(
            [
                service(ContainerInterface::class),
            ]
        );
};