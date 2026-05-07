<?php
require_once "BaseChimaTwigController.php";

class SearchController extends BaseChimaTwigController{
    public $template = "search.twig";

    public function getContext(): array
    {
        $context = parent::getContext();

        $type = $_GET['type'] ?? 'Все';
        $title = $_GET['title'] ?? '';
        $info = $_GET['info'] ?? '';

    $sql = <<<EOL
SELECT id, title, type, info
FROM fire_and_ice
WHERE (:title = '' OR title LIKE CONCAT('%', :title, '%'))
    AND (:info = '' OR info LIKE CONCAT('%', :info, '%'))
    AND (:type = 'Все' OR type = :type)
EOL;

        $query = $this->pdo->prepare($sql);
        $query->bindValue("title", $title);
        $query->bindValue("info", $info);
        $query->bindValue("type", $type);
        $query->execute();

        $context['objects'] = $query->fetchAll();

        return $context;
    }
}