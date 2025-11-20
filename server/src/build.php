<?php

// Абсолютная корневая директория билда
$baseDir = __DIR__; // /var/www/greek_gods/server/src

// Абсолютный путь к main.dot
$mainFile = $baseDir . '/main.dot';

// Абсолютный путь к финальному файлу
$finalFile = $baseDir . '/../build/final.dot';

// Части, которые нужно подключить
$parts = [
    $baseDir . '/names/demiurges.dot',
    $baseDir . '/names/gods.dot',
    $baseDir . '/names/titans.dot',
    $baseDir . '/names/heroes.dot',
    $baseDir . '/names/monsters.dot',
    $baseDir . '/clusters/chaos.dot',
    $baseDir . '/clusters/titans.dot',
    $baseDir . '/clusters/olympians.dot',
    $baseDir . '/clusters/heroes.dot',
    $baseDir . '/relations.dot',
];

// Читаем main.dot
if (!file_exists($mainFile)) {
    die("❌ Ошибка: main.dot не найден: $mainFile\n");
}

$main = file_get_contents($mainFile);

// Читаем контент частей
$content = '';

foreach ($parts as $path) {
    if (file_exists($path)) {
        $content .= "\n// === " . basename($path) . " ===\n" . file_get_contents($path) . "\n";
    } else {
        $content .= "\n// === Файл не найден: " . basename($path) . " ===\n";
    }
}

// Вставляем content перед последней '}'
$pos = strrpos($main, '}');
if ($pos === false) {
    die("❌ Ошибка: не найдена закрывающая скобка '}' в main.dot\n");
}

$final = substr($main, 0, $pos) . "\n" . $content . "\n}";

// Создаём папку build, если нет
$buildDir = $baseDir . '/../build';
if (!is_dir($buildDir)) {
    mkdir($buildDir, 0777, true);
}

// Записываем final.dot
file_put_contents($finalFile, $final);

echo "✅ Сборка завершена: $finalFile\n";
