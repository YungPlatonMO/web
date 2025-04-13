<?php
namespace MyProject\Classes;

require_once 'User.php';
require_once 'SuperUserInterface.php';

class SuperUser extends User implements SuperUserInterface {
    public $role;
    public static $superUserCount = 0;

    public function __construct($name, $login, $password, $role) {
        parent::__construct($name, $login, $password);
        $this->role = $role;
        self::$superUserCount++;
    }

    public function showInfo() {
        echo "Имя: {$this->name}" . PHP_EOL;
        echo "Логин: {$this->login}" . PHP_EOL;
        echo "Роль: {$this->role}" . PHP_EOL;
        echo "----------------------" . PHP_EOL;
    }

    public function getInfo() {
        return [
            'name' => $this->name,
            'login' => $this->login,
            'role' => $this->role
        ];
    }
}
?>