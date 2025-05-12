<?php
namespace Factory\Models;

class Users extends Collection
{
    public function __construct(public ?array $users = null)
    {
        $users ??= [
            new User(
                "anna.petrovna@gmail.com",
                "password",
                "Анна",
                "Петрова"),
            new User(
                "sergey.volkov@mail.ru",
                "password",
                "Сергей",
                "Волков"),
            new User(
                "maria.ivanova@yandex.ru",
                "password",
                "Мария",
                "Иванова"),
            new User(
                "daniil.kuznetsov@gmail.com",
                "password",
                "Даниил",
                "Кузнецов"),
            new User(
                "elena.smirnova@outlook.com",
                "password",
                "Елена",
                "Смирнова"),
            new User(
                "andrey.egorov@gmail.com",
                "password",
                "Андрей",)
        ];
        parent::__construct($users);
    }
}