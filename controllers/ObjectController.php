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

        $sql = "SELECT f.title, f.image, f.info, f.type, t.title as type_title 
                FROM fire_and_ice f 
                LEFT JOIN object_types t ON f.type = t.id 
                WHERE f.id = :id";
        
        $query = $this->pdo->prepare($sql);
        $query->bindValue("id", $id);
        $query->execute();
        $data = $query->fetch();

        if ($data) {
            $context['title'] = $data['title'];
            $context['image'] = $data['image'];
            $context['info'] = $data['info'];
            $context['type'] = $data['type'];
            $context['type_title'] = $data['type_title'];
        }

        $context['id'] = $id;

        return $context;
    }
}
