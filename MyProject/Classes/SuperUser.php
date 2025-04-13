<?php

declare(strict_types=1);

namespace MyProject\Classes;

require_once __DIR__ . '/User.php';
require_once __DIR__ . '/SuperUserInterface.php';

/**
 * Класс SuperUser
 * Представляет пользователя с расширенными привилегиями
 * 
 * @package MyProject\Classes
 */
class SuperUser extends User implements SuperUserInterface
{
    /** @var string Роль пользователя */
    public string $role;

    /** @var int Счетчик количества экземпляров класса SuperUser */
    private static int $superUserCount = 0;

    /**
     * Конструктор класса SuperUser
     * 
     * @param string $name Имя пользователя
     * @param string $login Логин пользователя
     * @param string $password Пароль пользователя
     * @param string $role Роль пользователя
     */
    public function __construct(string $name, string $login, string $password, string $role)
    {
        parent::__construct($name, $login, $password);
        $this->role = $role;
        self::$superUserCount++;
    }

    /**
     * Отображает информацию о пользователе, включая роль
     * 
     * @return void
     */
    public function showInfo(): void
    {
        parent::showInfo();
        echo "Роль: {$this->role}\n";
    }

    /**
     * Получить всю информацию о пользователе в виде ассоциативного массива
     * 
     * @return array
     */
    public function getInfo(): array
    {
        return [
            'name' => $this->name,
            'login' => $this->login,
            'role' => $this->role
        ];
    }

    /**
     * Получить общее количество экземпляров класса SuperUser
     * 
     * @return int
     */
    public static function getSuperUserCount(): int
    {
        return self::$superUserCount;
    }

    /**
     * Деструктор
     */
    public function __destruct()
    {
        parent::__destruct();
        self::$superUserCount--;
    }
} 