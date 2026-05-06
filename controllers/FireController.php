<?php

class FireController extends TwigBaseController {
    public $title = "Огонь";
    public $template = "__object.twig"; 

    public function getContext(): array {
        $context = parent::getContext();
        $context['base_url'] = "/fire"; 
        return $context;
    }
}