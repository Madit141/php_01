<?php
require_once "BaseChimaTwigController.php";

class LoginController extends BaseChimaTwigController {
    public $template = "login.twig";

    public function get(array $context) {
        parent::get($context);
    }

    public function post(array $context) {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $query = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $query->bindValue("username", $username);
        $query->execute();
        $user = $query->fetch();

        if ($user && $user['password'] === $password) {
            $_SESSION['is_logged'] = true;
            header("Location: /"); 
            exit;
        } else {
            $context['error'] = 'Неверный логин или пароль';
            $this->get($context);
        }
    }
}