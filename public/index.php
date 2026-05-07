<?php

require_once '../vendor/autoload.php';
require_once '../framework/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader, [
    "debug" => true // добавляем тут debug режим
]);
$twig->addExtension(new \Twig\Extension\DebugExtension()); // и активируем расширение

$url = $_SERVER["REQUEST_URI"];
$controller = new Controller404($twig);

// создаем экземпляр класса и передаем в него параметры подключения
// создание класса автоматом открывает соединение
$pdo = new PDO("mysql:host=localhost;dbname=legands_of_chima;charset=utf8", "root", "");

$router = new Router($twig, $pdo);
$router->add("/", MainController::class);
$router->add("/fire_and_ice/(?P<id>\d+)", ObjectController::class); 
$router->add("/search", SearchController::class);

$router->get_or_default(Controller404::class);