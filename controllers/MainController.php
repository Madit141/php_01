<?php
require_once "BaseChimaTwigController.php";

class MainController extends BaseChimaTwigController {
    public $template = "main.twig";
    public $title = "LEGO Chima";

    // добавим метод getContext()
    public function getContext(): array
    {
        $context = parent::getContext();

        $sql = "SELECT f.*, t.title as type_title 
            FROM fire_and_ice f 
            LEFT JOIN object_types t ON f.type = t.id";

        if(isset($_GET['type'])){
            $sql .= " WHERE f.type = :type";
            $query = $this->pdo->prepare($sql);
            $query->bindValue("type", $_GET['type']);
            $query->execute();
        } else {
            $query = $this->pdo->query($sql);
        }
        
        // стягиваем данные через fetchAll() и сохраняем результат в контекст
        $context['fire_and_ice'] = $query->fetchAll();

        return $context;
    }
}