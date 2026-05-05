<?php

require_once '../vendor/autoload.php';
require_once '../controllers/BaseController.php';
require_once '../controllers/TwigBaseController.php';
require_once '../controllers/Controller404.php';
require_once '../controllers/MainController.php';
require_once '../controllers/IceController.php';
require_once '../controllers/IceImageController.php';
require_once '../controllers/IceInfoController.php';
require_once '../controllers/FireController.php';
require_once '../controllers/FireImageController.php';
require_once '../controllers/FireInfoController.php';

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

if ($url == "/") {
    $controller = new MainController($twig);
} elseif (preg_match("#^/ice#", $url)) {
    $controller = new IceController($twig); 
    if ($url == "/ice/image") {
        $controller = new IceImageController($twig);
    } elseif ($url == "/ice/info") {
        $controller = new IceInfoController($twig);
    }
} elseif (preg_match("#^/fire#", $url)) {
    $controller = new FireController($twig); 
    if ($url == "/fire/image") {
        $controller = new FireImageController($twig);
    } elseif ($url == "/fire/info") {
        $controller = new FireInfoController($twig);
    }
}

if ($controller) {
    $controller->setPDO($pdo);
    $controller->get();
}