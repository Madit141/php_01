<?php

class BaseChimaTwigController extends TwigBaseController{
    public function getContext(): array
    {
        $context = parent::getContext();

        $query = $this->pdo->query("SELECT * FROM object_types");
        $context['types'] = $query->fetchAll();

        $context['history'] = isset($_SESSION['history']) ? $_SESSION['history'] : [];
        
        return $context;
    }
}