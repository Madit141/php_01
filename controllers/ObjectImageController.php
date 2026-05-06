<?php

class ObjectImageController extends TwigBaseController {
    public $template = "object_image.twig";

    public function getContext(): array
    {
        $context = parent::getContext();
        $id = $this->params['id'];

        $context['base_url'] = "/fire_and_ice/" . $id;

        $query = $this->pdo->prepare("SELECT title, image FROM fire_and_ice WHERE id = :id");
        $query->bindValue("id", $id);
        $query->execute();
        $data = $query->fetch();

        if ($data) {
            $context['title'] = $data['title'];
            $context['image'] = $data['image'];
        }

        return $context;
    }
}