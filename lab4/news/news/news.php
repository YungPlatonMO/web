<?php
require_once "NewsDB.class.php";

$news = new NewsDB();

// Переменная для хранения сообщений об ошибках
$errMsg = "";

// Проверяем, была ли отправлена форма
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require "save_news.inc.php";
}

// Проверяем запрос на удаление новости
if (isset($_GET['del'])) {
    require "delete_news.inc.php";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Новостная лента</title>
	<meta charset="utf-8">
</head>
<body>
<div class='container'>
    <div class="news-section">
  <h1>Последние новости</h1>
  <?php
//   // Выводим сообщение об ошибке, если оно есть
//   if (!empty($errMsg)) {
//       echo "<div class='error-message'>{$errMsg}</div>";
//   }
  
  // Выводим новости
  require "get_news.inc.php";
  ?>
  </div>
  
      <div class="form-selection">
          
          <h1>Создание новости</h1>
          
          <?php
        
  // Выводим сообщение об ошибке, если оно есть
  if (!empty($errMsg)) {
      echo "<div class='error-message'>{$errMsg}</div>";
  }
        ?>
          <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
            Заголовок новости:<br>
            <input type="text" name="title"><br>
            Выберите категорию:<br>
            <select name="category">
              <option value="1">Политика</option>
              <option value="2">Культура</option>
              <option value="3">Спорт</option>
            </select>
            <br />
            Текст новости:<br>
            <textarea name="description" cols="50" rows="5"></textarea><br>
            Источник:<br>
            <input type="text" name="source"><br>
            <br>
            <input type="submit" value="Добавить!">
          </form>
          </div>

    </div>
  <?php

  ?>
</body>
</html>