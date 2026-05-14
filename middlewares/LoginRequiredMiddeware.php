<?php

class LoginRequiredMiddeware extends BaseMiddleware {
    public function apply(BaseController $controller, array $context)
    {
        $authUser = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : '';
        $authPassword = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';

        $query = $controller->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $query->bindValue("username", $authUser);
        $query->execute();

        $userFromDB = $query->fetch();

        $isAuthenticated = false;

        if ($userFromDB) {
            if ($userFromDB['password'] === $authPassword) {
                $isAuthenticated = true; 
            }
        }

        if (!$isAuthenticated) {
            header('WWW-Authenticate: Basic realm="LEGO Chima"'); 
            http_response_code(401);
            exit; 
        }
    }
}