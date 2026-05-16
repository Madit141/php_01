<?php

require_once '../vendor/autoload.php';
require_once '../framework/autoload.php';
require_once '../middlewares/LoginRequiredMiddeware.php';

session_set_cookie_params(60 * 60 * 10);
session_start();

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
$router->add("/login", LoginController::class);
$router->add("/logout", LogoutController::class);
$router->add("/", MainController::class)
        ->middleware(new LoginRequiredMiddeware());
$router->add("/fire_and_ice/(?P<id>\d+)", ObjectController::class)
        ->middleware(new LoginRequiredMiddeware()); 
$router->add("/search", SearchController::class)
        ->middleware(new LoginRequiredMiddeware());
$router->add("/create", ChimaObjectCreateController::class)
        ->middleware(new LoginRequiredMiddeware());
$router->add("/type_create", TypeCreateController::class)
        ->middleware(new LoginRequiredMiddeware());
$router->add("/fire_and_ice/delete", ChimaObjectDeleteController::class)
        ->middleware(new LoginRequiredMiddeware());
$router->add("/fire_and_ice/(?P<id>\d+)/edit", ChimaObjectUpdateController::class)
        ->middleware(new LoginRequiredMiddeware());
$router->add("/set-welcome/", SetWelcomeController::class);

$router->get_or_default(Controller404::class);