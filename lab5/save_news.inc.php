<?php
// Проверка, был ли отправлен POST запрос и заполнены все необходимые поля
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title'], $_POST['category'], $_POST['description'], $_POST['source'])) {
    
    // Проверяем, что заполнены все обязательные поля
    if (empty($_POST['title']) || empty($_POST['description'])) {
        $errMsg = "Заполните все поля формы!";
    } else {
        // Получаем данные из формы и фильтруем их
        $title = trim(strip_tags($_POST['title']));
        $category = (int)$_POST['category'];
        $description = trim(strip_tags($_POST['description']));
        $source = trim(strip_tags($_POST['source']));
        
        // Создаем экземпляр класса NewsDB
        require_once "NewsDB.class.php";
        $news = new NewsDB();
        
        // Сохраняем новость
        if ($news->saveNews($title, $category, $description, $source)) {
            // Если успешно, перезагружаем страницу чтобы избежать повторной отправки формы
            header("Location: ".$_SERVER['PHP_SELF']);
            exit;
        } else {
            $errMsg = "Произошла ошибка при добавлении новости.";
        }
    }
}