<?php

class HistoryMiddeware extends BaseMiddleware {
    public function apply(BaseController $controller, array $context)
    {
        if (!isset($_SESSION['history'])) {
            $_SESSION['history'] = [];
        }

        $current_url = urldecode($_SERVER['REQUEST_URI']);

        if (empty($_SESSION['history']) || $_SESSION['history'][0] !== $current_url) {
            array_unshift($_SESSION['history'], $current_url);
        }

        if (count($_SESSION['history']) > 10) {
            $_SESSION['history'] = array_slice($_SESSION['history'], 0, 10);
        }
    }
}