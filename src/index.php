<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Ambitia\Example\Test\IndexEntry;
use Ambitia\Interfaces\Routing\RouterInterface;
use Ambitia\Interfaces\DIContainer\ContainerInterface;

$containerConfig = include __DIR__ . '/Config/dependencies.php';
$containerClass = $containerConfig['map'][ContainerInterface::class];
$container = new $containerClass($containerConfig);

/** @var RouterInterface $router */
$router = $container->get(RouterInterface::class);
$router->route('GET', 'index', '/', [IndexEntry::class, 'index']);

$router->run();
