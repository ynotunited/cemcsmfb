<?php
// Bootstrap file
require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/app/Router.php';

// Instantiate the router
$router = new Router();

// Load routes
require_once dirname(__DIR__) . '/app/routes.php';

// Dispatch the current URL
$url = $_GET['url'] ?? '';
$router->dispatch($url);
