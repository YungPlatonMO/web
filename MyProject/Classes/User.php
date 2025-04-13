<?php
namespace MyProject\Classes;

require_once 'AbstractUser.php';

class User extends AbstractUser {
    public $name;
    public $login;
    private $password;
    public static $userCount = 0;

    public function __construct($name, $login, $password) {
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
        self::$userCount++;
        echo "Пользователь {$this->login} создан." . PHP_EOL;
    }

    public function __destruct() {
        echo "Пользователь {$this->login} удален." . PHP_EOL;
    }

    public function showInfo() {
        echo "Имя: {$this->name}" . PHP_EOL;
        echo "Логин: {$this->login}" . PHP_EOL;
        echo "----------------------" . PHP_EOL;
    }
}
?>