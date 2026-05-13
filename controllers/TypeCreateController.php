<?php
require_once "BaseChimaTwigController.php";

class TypeCreateController extends BaseChimaTwigController {
    public $template = "type_create.twig";

    public function get(array $context) {
        $query = $this->pdo->query("SELECT * FROM object_types");
        $context['types'] = $query->fetchAll();

        parent::get($context);
    }
    public function post(array $context) {
        $title = "";

        if (isset($_POST['title'])) {
            $title = $_POST['title'];
        }

        $image_url = "";
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $name = $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], "../public/media/$name");
            $image_url = "/media/$name";
        }
        $sql = <<<EOL
INSERT INTO object_types(title, image)
VALUES(:title, :image)
EOL;
        $query = $this->pdo->prepare($sql);
        $query->execute([
            'title' => $title,
            'image' => $image_url
        ]);

        $context['message'] = "Клан «{$title}» успешно добавлен!";
        $this->get($context);
    }
}