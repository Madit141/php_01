<?php
require_once "FireController.php";

class FireImageController extends FireController {
    public $template = "object_image.twig"; 

    public function getContext(): array {
        $context = parent::getContext();
        $context['image'] = "/images/fiery_temple.jpg"; 
        return $context;
    }
}