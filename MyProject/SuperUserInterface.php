<?php

declare(strict_types=1);

namespace MyProject\Classes;

/**
 * Интерфейс SuperUserInterface
 * Определяет контракт для привилегированных пользователей
 * 
 * @package MyProject\Classes
 */
interface SuperUserInterface
{
    /**
     * Получить информацию о пользователе в виде массива
     * 
     * @return array
     */
    public function getInfo(): array;
} 