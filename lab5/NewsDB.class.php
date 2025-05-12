<?php
require_once "INewsDB.class.php";

/**
 * Class NewsDB
 * Реализует интерфейс INewsDB для работы с новостной лентой
 * Хранит новости в базе данных SQLite
 */
class NewsDB implements INewsDB, IteratorAggregate {
    
    // Константа с именем базы данных
    const DB_NAME = __DIR__ . '/news.db';
    private $_db;
    private $items = [];
    
    protected function getDb() {
        return $this->_db;
    }
    
     /**
     * Конструктор класса
     * Устанавливает соединение с базой данных
     */
    function __construct() {
        if (!file_exists(self::DB_NAME)) {
            // Устанавливаем соединение или создаем новую БД
            $this->_db = new SQLite3(self::DB_NAME);

            
            // Создаем таблицы
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
            
            // Заполняем таблицу category
            $this->_db->exec("INSERT INTO category(id, name)
                SELECT 1 as id, 'Политика' as name
                UNION SELECT 2 as id, 'Культура' as name
                UNION SELECT 3 as id, 'Спорт' as name");
        } else {
            // Открываем существующую базу данных
            $this->_db = new SQLite3(self::DB_NAME);
        }
        $this->getCategories();
    }
    
    /**
     * Деструктор класса
     * Закрывает соединение с базой данных
     */
    function __destruct() {
        $this->_db->close();
    }
    
    /**
     * Добавление новой записи в новостную ленту
     * 
     * @param string $title - заголовок новости
     * @param string $category - категория новости
     * @param string $description - текст новости
     * @param string $source - источник новости
     * 
     * @return boolean - результат успех/ошибка
     */
    
    function saveNews($title, $category, $description, $source) {
        $dt = time();
        
        // Подготавливаем запрос на вставку данных
        $stmt = $this->_db->prepare("INSERT INTO msgs (title, category, description, source, datetime) 
                                   VALUES (:title, :category, :description, :source, :datetime)");
        
        // Привязываем параметры
        $stmt->bindParam(':title', $title, SQLITE3_TEXT);
        $stmt->bindParam(':category', $category, SQLITE3_INTEGER);
        $stmt->bindParam(':description', $description, SQLITE3_TEXT);
        $stmt->bindParam(':source', $source, SQLITE3_TEXT);
        $stmt->bindParam(':datetime', $dt, SQLITE3_INTEGER);
        
      
        // Выполняем запрос и возвращаем результат операции
        return $stmt->execute() !== false;
    }
    
    /**
     * Выборка всех записей из новостной ленты
     * 
     * @return array - результат выборки в виде массива
     */
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
    
      /**
     * Удаление записи из новостной ленты
     * 
     * @param integer $id - идентификатор удаляемой записи
     * 
     * @return boolean - результат успех/ошибка
     */
    function deleteNews($id) {
        // Запрос на удаление
        $stmt = $this->_db->prepare("DELETE FROM msgs WHERE id = :id");
        
        
        $stmt->bindParam(':id', $id, SQLITE3_INTEGER);
        
        
        
        
        return $stmt->execute() !== false;
    }

    

    private function getCategories() {
        $this->items = [];
        $sql = "SELECT id, name FROM category";
        $result = $this->_db->query($sql);
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $this->items[$row['id']] = $row['name'];
        }
    }
/**
     * Реализация интерфейса IteratorAggregate
     * 
     * @return Traversable - возвращает объект-итератор
     */
    function getIterator(): Traversable {
        // $this->items = $this->getNews();
        return new ArrayIterator($this->items);
    }
}
