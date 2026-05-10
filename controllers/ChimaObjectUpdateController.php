<?php
require_once "BaseChimaTwigController.php";

class ChimaObjectUpdateController extends BaseChimaTwigController {
    public $template = "edit.twig";

    public function post(array $context) {
        $id = $this->params['id'];
        
        $old_object_query = $this->pdo->prepare("SELECT image FROM fire_and_ice WHERE id = :id");
        $old_object_query->execute(['id' => $id]);
        $old_object = $old_object_query->fetch();
        $image_url = $old_object['image'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['image']['tmp_name'];
            $name = $_FILES['image']['name'];
            move_uploaded_file($tmp_name, "../public/media/$name");
            $image_url = "/media/$name";
        }

        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $info = $_POST['info'];

    $sql = <<<EOL
UPDATE fire_and_ice 
SET title = :title, description = :description, type = :type, info = :info, image = :image 
WHERE id = :id
EOL;

        $query = $this->pdo->prepare($sql);
        $query->execute([
            'title' => $title,
            'description' => $description,
            'type' => $type,
            'info' => $info,
            'image' => $image_url,
            'id' => $id
        ]);

        $context['message'] = "Объект полностью обновлен!";
        $this->get($context);
    }
    public function get(array $context) {
        $id = $this->params['id'];

        $sql = "SELECT * FROM fire_and_ice WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        $query->bindValue("id", $id);
        $query->execute();
        
        $context['object'] = $query->fetch();

        parent::get($context);
    }
}