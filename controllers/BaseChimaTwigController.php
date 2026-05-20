<?php

class BaseChimaTwigController extends TwigBaseController{
    public function getContext(): array
    {
        $context = parent::getContext();

        $query = $this->pdo->query("SELECT * FROM object_types");
        $context['types'] = $query->fetchAll();

        $context['history'] = isset($_SESSION['history']) ? $_SESSION['history'] : [];
        
        $context['my_session_message'] = isset($_SESSION['welcome_message']) ? $_SESSION['welcome_message'] : '';

        $context['messages'] = isset($_SESSION['messages']) ? $_SESSION['messages'] : [];
        
        return $context;
    }
}