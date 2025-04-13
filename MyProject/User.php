<?php

declare(strict_types=1);

namespace MyProject\Classes;

require_once __DIR__ . '/AbstractUser.php';

/**
 * Класс User
 * Представляет базового пользователя в системе
 * 
 * @package MyProject\Classes
 */
class User extends AbstractUser
{
    /** @var string Имя пользователя */
    public string $name;
    
    /** @var string Логин пользователя */
    public string $login;
    
    /** @var string Пароль пользователя */
    private string $password;

    /** @var int Счетчик количества экземпляров класса User */
    private static int $userCount = 0;

    /**
     * Конструктор класса User
     * 
     * @param string $name Имя пользователя
     * @param string $login Логин пользователя
     * @param string $password Пароль пользователя
     */
    public function __construct(string $name, string $login, string $password)
    {
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
        
        // Увеличиваем счетчик только если это экземпляр класса User (не SuperUser)
        if (get_class($this) === User::class) {
            self::$userCount++;
        }
    }

    /**
     * Отображает информацию о пользователе
     * 
     * @return void
     */
    public function showInfo(): void
    {
        echo "Информация о пользователе:\n";
        echo "Имя: {$this->name}\n";
        echo "Логин: {$this->login}\n";
    }

    /**
     * Деструктор
     */
    public function __destruct()
    {
        echo "Пользователь {$this->login} удален.<br>";
    }

    /**
     * Получить общее количество экземпляров класса User
     * 
     * @return int
     */
    public static function getUserCount(): int
    {
        return self::$userCount;
    }
} 