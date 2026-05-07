<?php
require_once "BaseChimaTwigController.php";

class MainController extends BaseChimaTwigController {
    public $template = "main.twig";
    public $title = "LEGO Chima";

    // добавим метод getContext()
    public function getContext(): array
    {
        $context = parent::getContext();

        if(isset($_GET['type'])){
            $query = $this->pdo->prepare("SELECT * FROM fire_and_ice WHERE type = :type");
            $query->bindValue("type", $_GET['type']);
            $query->execute();
        }else{
            $query = $this->pdo->query("SELECT * FROM fire_and_ice");
        }
        
        // стягиваем данные через fetchAll() и сохраняем результат в контекст
        $context['fire_and_ice'] = $query->fetchAll();

        return $context;
    }
}