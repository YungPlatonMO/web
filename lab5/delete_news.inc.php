<?php
// Проверка запроса на удаление новости
if (isset($_GET['del'])) {
    // Получаем ID новости для удаления
    $id = (int)$_GET['del'];
    
    // Проверяем, что ID > 0
    if ($id > 0) {
        // Создаем экземпляр класса NewsDB
        require_once "NewsDB.class.php";
        $news = new NewsDB();
        
        // Удаляем новость
        if ($news->deleteNews($id)) {
            // Если успешно, перезагружаем страницу без GET-параметра
            header("Location: ".$_SERVER['PHP_SELF']);
            exit;
        } else {
            $errMsg = "Произошла ошибка при удалении новости.";
        }
    } else {
        // Перезагружаем страницу без GET-параметра, так как ID некорректный
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }
}