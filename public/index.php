<?php
require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader);

$url = $_SERVER["REQUEST_URI"];
$context = [];


$context['menu'] = [
    ["title" => "LEGO Chima", "url" => "/"],
    ["title" => "Лед", "url" => "/ice"],
    ["title" => "Огонь", "url" => "/fire"]
];

if ($url == "/") {
    $context['title'] = "LEGO Chima";
    $template = "main.twig";
} 

elseif (preg_match("#^/ice#", $url)) {
    $context['title'] = "Лед";
    $context['base_url'] = "/ice";
    
    if ($url == "/ice/image") {
        $context['image'] = "/images/ice_mammoth.jpg";
        $template = "object_image.twig";
    } elseif ($url == "/ice/info") {
        $template = "ice_info.twig";
    } else {
        $template = "__object.twig";
    }
} 

elseif (preg_match("#^/fire#", $url)) {
    $context['title'] = "Огонь";
    $context['base_url'] = "/fire";

    if ($url == "/fire/image") {
        $context['image'] = "/images/fiery_temple.jpg";
        $template = "object_image.twig";
    } elseif ($url == "/fire/info") {
        $template = "fire_info.twig";
    } else {
        $template = "__object.twig";
    }
}

echo $twig->render($template, $context);