<?php
require_once "INewsDB.class.php";

class NewsDB implements INewsDB {
    
    const DB_NAME = __DIR__ . '/news.db';
    private $_db;
    
    protected function getDb() {
        return $this->_db;
    }
    
     
    function __construct() {
        if (!file_exists(self::DB_NAME)) {
            $this->_db = new SQLite3(self::DB_NAME);
            
            $this->_db->exec("CREATE TABLE msgs(
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title TEXT,
                category INTEGER,
                description TEXT,
                source TEXT,
                datetime INTEGER
            )");
            
            $this->_db->exec("CREATE TABLE category(
                id INTEGER,
                name TEXT
            )");
            
            $this->_db->exec("INSERT INTO category(id, name)
                SELECT 1 as id, 'Политика' as name
                UNION SELECT 2 as id, 'Культура' as name
                UNION SELECT 3 as id, 'Спорт' as name");
        } else {
            $this->_db = new SQLite3(self::DB_NAME);
        }
    }
    
    function __destruct() {
        $this->_db->close();
    }
    
    
    function saveNews($title, $category, $description, $source) {
        $dt = time();
        
        $stmt = $this->_db->prepare("INSERT INTO msgs (title, category, description, source, datetime) 
                                   VALUES (:title, :category, :description, :source, :datetime)");
        
        $stmt->bindParam(':title', $title, SQLITE3_TEXT);
        $stmt->bindParam(':category', $category, SQLITE3_INTEGER);
        $stmt->bindParam(':description', $description, SQLITE3_TEXT);
        $stmt->bindParam(':source', $source, SQLITE3_TEXT);
        $stmt->bindParam(':datetime', $dt, SQLITE3_INTEGER);
        
      
        // Выполняем запрос и возвращаем результат операции
        return $stmt->execute() !== false;
    }
    
    function getNews() {
        // Запрос на выборку всех новостей с информацией о категории
        $sql = "SELECT msgs.id as id, title, category.name as category, description, source, datetime 
                FROM msgs, category 
                WHERE category.id = msgs.category 
                ORDER BY msgs.id DESC";
        
        $result = $this->_db->query($sql);
        
        // Проверяем успешность выполнения запроса
        if (!$result){ 
            return false;
            
        }
            
        // Формируем массив с результатами
        $items = array();
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $items[] = $row;
        }
        return $items;
    }
    
     
    function deleteNews($id) {
        $stmt = $this->_db->prepare("DELETE FROM msgs WHERE id = :id");
        $stmt->bindParam(':id', $id, SQLITE3_INTEGER);
        return $stmt->execute() !== false;
    }
}