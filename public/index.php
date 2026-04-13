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
$twig = new \Twig\Environment($loader);

$url = $_SERVER["REQUEST_URI"];
$controller = new Controller404($twig);

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

$controller->get();