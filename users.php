<?php
use MyProject\Classes\User;
use MyProject\Classes\SuperUser;

spl_autoload_register(function ($className) {
    $className = str_replace('\\', '/', $className);
    require_once __DIR__ . "/$className.php";
});

// Создание объектов
$user1 = new User("Алексей Петров", "alex_petrov", "secret123");
$user2 = new User("Ольга Смирнова", "olga_smirnova", "qwerty456");
$user3 = new User("Иван Иванов", "ivan_ivanov", "password789");
$superUser = new SuperUser("Админ", "admin", "root123", "Суперпользователь");

// Вызов методов
$user1->showInfo();
$user2->showInfo();
$user3->showInfo();
$superUser->showInfo();

// Вызов метода getInfo()
print_r($superUser->getInfo());

// Вывод статистики
echo "Всего обычных пользователей: " . User::$userCount . PHP_EOL;
echo "Всего супер-пользователей: " . SuperUser::$superUserCount . PHP_EOL;
?>