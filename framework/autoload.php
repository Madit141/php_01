<?php

spl_autoload_register(function($class) {
    // Список папок, в которых могут лежать классы
    $dirs = [
        __DIR__ . '/../framework/',
        __DIR__ . '/../controllers/',
    ];

    foreach ($dirs as $dir) {
        $fn = $dir . $class . '.php';
        if (file_exists($fn)) {
            require_once $fn;
            return; // Если нашли файл, выходим из функции
        }
    }
});