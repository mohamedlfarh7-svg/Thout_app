<?php
require_once '../app/core/Router.php';
require_once '../config/database.php';

$router = new Router();

$router->get('/login', [StudentController::class, 'login']);
$router->post('/login', [StudentController::class, 'login']);
$router->get('/register', [StudentController::class, 'register']);
$router->post('/register', [StudentController::class, 'register']);
$router->get('/dashboard', [StudentController::class, 'dashboard']);
$router->get('/logout', [StudentController::class, 'logout']);

$router->dispatch();
?>