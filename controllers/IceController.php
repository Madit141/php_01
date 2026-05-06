<?php

class IceController extends TwigBaseController {
    public $title = "Лед";
    public $template = "__object.twig";

    public function getContext(): array {
        $context = parent::getContext();
        $context['base_url'] = "/ice"; 
        return $context;
    }
}