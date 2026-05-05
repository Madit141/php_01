<?php
require_once "TwigBaseController.php"; // импортим TwigBaseController

class MainController extends TwigBaseController {
    public $template = "main.twig";
    public $title = "LEGO Chima";

    // добавим метод getContext()
    public function getContext(): array
    {
        $context = parent::getContext();

        // подготавливаем запрос SELECT * FROM space_objects
        // вообще звездочку не рекомендуется использовать, но на первый раз пойдет
        $query = $this->pdo->query("SELECT * FROM fire_and_ice");
        
        // стягиваем данные через fetchAll() и сохраняем результат в контекст
        $context['fire_and_ice'] = $query->fetchAll();

        return $context;
    }
}