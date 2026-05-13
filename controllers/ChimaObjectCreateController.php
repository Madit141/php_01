<?php
require_once "BaseChimaTwigController.php";

class ChimaObjectCreateController extends BaseChimaTwigController {
    public $template = "create.twig";

    public function get(array $context) // добавили параметр
    {   
        $query = $this->pdo->query("SELECT * FROM object_types");
        $context['types'] = $query->fetchAll();
        parent::get($context); // пробросили параметр
    }

    public function post(array $context) {
        // получаем значения полей с формы
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $info = $_POST['info'];

        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];
        
        // используем функцию которая проверяет
        // что файл действительно был загружен через POST запрос
        // и если это так, то переносит его в указанное во втором аргументе место
        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name";

        // создаем текст запрос
        $sql = <<<EOL
INSERT INTO fire_and_ice(title, description, type, info, image)
VALUES(:title, :description, :type, :info, :image_url)
EOL;

        $query = $this->pdo->prepare($sql);
        $query->execute([
            'title' => $title,
            'description' => $description,
            'type' => $type,
            'info' => $info,
            'image_url' => $image_url
        ]);
        
        $context['message'] = 'Вы успешно создали объект';
        $this->get($context);
    }
}