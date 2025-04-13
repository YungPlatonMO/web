<?php

declare(strict_types=1);

namespace MyProject\Classes;

/**
 * Абстрактный класс AbstractUser
 * Базовый класс для всех типов пользователей
 * 
 * @package MyProject\Classes
 */
abstract class AbstractUser
{
    /**
     * Отображает информацию о пользователе
     * 
     * @return void
     */
    abstract public function showInfo(): void;
} 