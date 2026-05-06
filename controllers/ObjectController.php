<?php

class ObjectController extends TwigBaseController {
    public $template = "__object.twig"; // указываем шаблон

    public function getContext(): array
    {
        $context = parent::getContext();
        
        // готовим запрос к БД, допустим вытащим запись по id=3
        // тут уже указываю конкретные поля, там более грамотно
        $id = $this->params['id'];
        $context['base_url'] = "/fire_and_ice/" . $id;

        $query = $this->pdo->prepare("SELECT title, info, id FROM fire_and_ice WHERE id = :my_id");
        $query->bindValue("my_id", $id);
        $query->execute();
        $data = $query->fetch();

        if ($data) {
            $context['title'] = $data['title'];
            $context['info'] = $data['info'];
        }

        return $context;
    }
}
