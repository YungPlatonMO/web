<?php

// mvc_use.php (Main File - MVC Execution)
require_once 'User.php';
require_once 'UserController.php';
require_once 'MarkdownView.php';

// 1. Model (Data)
$users = [
    new User('Иван', 'Admin', 'ivan@example.com'),
    new User('Мария', 'Manager', 'maria@example.com'),
    new User('Сергей', 'Visitor', 'sergey@example.com'),
    new User('Елена', 'Editor', 'elena@example.com'),
    new User('Дмитрий', 'Subscriber', 'dmitry@example.com'),
];

// 2. Controller (Logic)
$userController = new UserController($users);
$usersFromController = $userController->getUsers();

// 3. View (Presentation)
$markdownView = new MarkdownView();
$markdownOutput = $markdownView->render($usersFromController);

// Output the Markdown
echo $markdownOutput;
