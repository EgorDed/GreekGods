<?php
$parts = [
    'names/gods.dot',
    'names/titans.dot',
    'names/heroes.dot',
    'names/monsters.dot',
    'clusters/chaos.dot',
    'clusters/titans.dot',
    'clusters/olympians.dot',
    'clusters/heroes.dot',
    'relations.dot',
];

$main = file_get_contents('main.dot');
$content = '';

foreach ($parts as $path) {
    if (file_exists($path)) {
        $content .= "\n// === {$path} ===\n" . file_get_contents($path) . "\n";
    }
}

// Надёжно ищем последнюю "}" и вставляем перед ней
$pos = strrpos($main, '}');
if ($pos === false) {
    die("❌ Ошибка: не найдена закрывающая скобка '}' в main.dot\n");
}

$final = substr($main, 0, $pos) . "\n" . $content . "\n}";
@mkdir('build', 0777, true);
file_put_contents('build/final.dot', $final);

echo "✅ Сборка завершена: build/final.dot\n";
