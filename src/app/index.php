<?php

require_once dirname(__FILE__) . '/../../vendor/autoload.php';

use App\Core\Router;
use App\Core\Migrator;
use App\Controllers\HomeController;
use App\Controllers\ContactController;
use App\Controllers\PostController;

// Run Migrations
$migrator = new Migrator();
$migrator->migrate();

$router = new Router();

// Web Routes
$router->get('/', [HomeController::class, 'index']);
$router->get('/chat', [HomeController::class, 'chat']);

// API Routes
$router->post('/contact.php', [ContactController::class, 'submit']); // Keep compatibility with existing JS
$router->get('/api/posts', [PostController::class, 'index']);
$router->post('/api/posts', [PostController::class, 'store']);

$router->resolve();
