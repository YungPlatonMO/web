<?php
declare(strict_types=1);

spl_autoload_register();

use Singleton\Settings;

$settings = Settings::get();

// Сохраняем различные типы значений
$settings->items_per_page = 20;     
$settings->string_value = 'my site'; 
$settings->boolean_value = true;     

// Вывод значений на экран
echo "<p>Элементов на странице: " . $settings->items_per_page . "\n</p>";
echo "<p>Название сайта: " . $settings->string_value . "\n</p>";
echo "<p>Активен ли сайт: " . ($settings->boolean_value ? 'Да' : 'Нет') . "\n</p>"; 