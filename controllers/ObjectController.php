<?php
require_once "BaseChimaTwigController.php";

class ObjectController extends BaseChimaTwigController {
    public $template = "__object.twig"; // указываем шаблон

    public function getContext(): array
    {
        $context = parent::getContext();
        $id = $this->params['id'];

        // Забираем из GET-параметра, что именно показывать (по умолчанию - ничего)
        $context['show'] = $_GET['show'] ?? 'default';

        // Тянем данные из БД
        $query = $this->pdo->prepare("SELECT title, image, info, type FROM fire_and_ice WHERE id = :id");
        $query->bindValue("id", $id);
        $query->execute();
        $data = $query->fetch();

        if ($data) {
            $context['title'] = $data['title'];
            $context['image'] = $data['image'];
            $context['info'] = $data['info'];
            $context['type'] = $data['type'];
        }

        $context['id'] = $id;

        return $context;
    }
}
