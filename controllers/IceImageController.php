<?php
require_once "IceController.php"; 

class IceImageController extends IceController {
    public $template = "object_image.twig";

    public function getContext(): array {
        $context = parent::getContext(); 
        $context['image'] = "/images/ice_mammoth.jpg"; 
        return $context;
    }
}