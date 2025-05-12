<?php

namespace lab2;

/**
 * EN: Mediator Design Pattern
 *
 * Intent: Lets you reduce chaotic dependencies between objects. The pattern
 * restricts direct communications between the objects and forces them to
 * collaborate only via a mediator object.
 *
 * RU: Паттерн Посредник
 *
 * Назначение: Позволяет уменьшить связанность множества классов между собой,
 * благодаря перемещению этих связей в один класс-посредник.
 */

/**
 * EN: The Mediator interface declares a method used by components to notify the
 * mediator about various events. The Mediator may react to these events and
 * pass the execution to other components.
 *
 * RU: Интерфейс Посредника предоставляет метод, используемый компонентами для
 * уведомления посредника о различных событиях. Посредник может реагировать на
 * эти события и передавать исполнение другим компонентам.
 */
interface Mediator
{
    public function notify(object $sender, string $event): void;
}

/**
 * EN: Concrete Mediators implement cooperative behavior by coordinating several
 * components.
 *
 * RU: Конкретные Посредники реализуют совместное поведение, координируя
 * отдельные компоненты.
 */
class ConcreteMediator implements Mediator
{
    private $component1;

    private $component2;

    public function __construct(Component1 $c1, Component2 $c2)
    {
        $this->component1 = $c1;
        $this->component1->setMediator($this);
        $this->component2 = $c2;
        $this->component2->setMediator($this);
    }

    public function notify(object $sender, string $event): void
    {
        if ($event == "A") {
            echo "Посредник реагирует на A и запускает следующие операции:\n";
            $this->component2->doC();
        }

        if ($event == "D") {
            echo "Посредник реагирует на D и запускает следующие операции:\n";
            $this->component1->doB();
            $this->component2->doC();
        }
    }
}

/**
 * EN: The Base Component provides the basic functionality of storing a
 * mediator's instance inside component objects.
 *
 * RU: Базовый Компонент обеспечивает базовую функциональность хранения
 * экземпляра посредника внутри объектов компонентов.
 */
class BaseComponent
{
    protected $mediator;

    public function __construct(Mediator $mediator = null)
    {
        $this->mediator = $mediator;
    }

    public function setMediator(Mediator $mediator): void
    {
        $this->mediator = $mediator;
    }
}

/**
 * EN: Concrete Components implement various functionality. They don't depend on
 * other components. They also don't depend on any concrete mediator classes.
 *
 * RU: Конкретные Компоненты реализуют различную функциональность. Они не
 * зависят от других компонентов. Они также не зависят от каких-либо конкретных
 * классов посредников.
 */
class Component1 extends BaseComponent
{
    public function doA(): void
    {
        echo "Компонент 1 выполняет A.\n";
        $this->mediator->notify($this, "A");
    }

    public function doB(): void
    {
        echo "Компонент 1 выполняет B.\n";
        $this->mediator->notify($this, "B");
    }
}

class Component2 extends BaseComponent
{
    public function doC(): void
    {
        echo "Компонент 2 выполняет C.\n";
        $this->mediator->notify($this, "C");
    }

    public function doD(): void
    {
        echo "Компонент 2 выполняет D.\n";
        $this->mediator->notify($this, "D");
    }
}

/**
 * EN: The client code.
 *
 * RU: Клиентский код.
 */
echo '<pre>';
$c1 = new Component1();
$c2 = new Component2();
$mediator = new ConcreteMediator($c1, $c2);

echo "Клиент запускает операцию A.\n";
$c1->doA();

echo "\n";
echo "Клиент запускает операцию D.\n";
$c2->doD();
echo '</pre>';
