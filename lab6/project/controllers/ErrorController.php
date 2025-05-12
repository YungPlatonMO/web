<?php
namespace Project\Controllers;
use \Core\Controller;

public title
class ErrorController extends Controller
{
    public function notFound() {
        $this->title = 'Страница не найдена';
        return $this->render('error/notFound');
    }
}