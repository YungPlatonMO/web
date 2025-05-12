<?php
require_once "NewsDB.class.php";

// Создаем экземпляр класса NewsDB
$news = new NewsDB();

// Получаем все новости
$newsItems = $news->getNews();

// Проверяем результат запроса
if ($newsItems === false) {
    $errMsg = "Произошла ошибка при выводе новостной ленты";
} else {
    // Выводим количество новостей
    $newsCount = count($newsItems);
    echo "<p>Всего новостей: {$newsCount}</p>";
    
    // Если есть новости, выводим их
    if ($newsCount > 0) {
        echo "<div class='news-container'>";
        foreach ($newsItems as $item) {
            // Форматируем дату
            $date = date("d.m.Y H:i", $item['datetime']);
            echo "<div class='news-item'>";
            echo "<h3>{$item['title']}</h3>";
            echo "<div class='news-meta'>";
            echo "<span class='category'>Категория: {$item['category']}</span>, <br>";
            echo "<span class='date'>Дата: {$date}</span>";
            echo '<br>';
            if (!empty($item['source'])) {
                echo "<span class='source'>Источник: {$item['source']}</span>";
            }
            echo "</div>";
            echo "<div class='news-text'>" . nl2br($item['description']) . "</div>";
            echo "<div class='news-actions'>";
            echo "<a href='{$_SERVER['PHP_SELF']}?del={$item['id']}' class='delete-button'>Удалить</a>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p>Новостей пока нет.</p>";
    }
}
