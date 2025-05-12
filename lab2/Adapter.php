<?php

namespace lab2;

/**
 * EN: Adapter Design Pattern
 *
 * Intent: Provides a unified interface that allows objects with incompatible
 * interfaces to collaborate.
 *
 * RU: Паттерн Адаптер
 *
 * Назначение: Позволяет объектам с несовместимыми интерфейсами работать вместе.
 */

/**
 * EN: The Target defines the domain-specific interface used by the client code.
 *
 * RU: Целевой класс объявляет интерфейс, с которым может работать клиентский
 * код.
 */
class Target
{
    public function request(): string
    {
        return "Цель: поведение цели по умолчанию..";
    }
}

/**
 * EN: The Adaptee contains some useful behavior, but its interface is
 * incompatible with the existing client code. The Adaptee needs some adaptation
 * before the client code can use it.
 *
 * RU: Адаптируемый класс содержит некоторое полезное поведение, но его
 * интерфейс несовместим с существующим клиентским кодом. Адаптируемый класс
 * нуждается в некоторой доработке, прежде чем клиентский код сможет его
 * использовать.
 */
class Adaptee
{
    public function specificRequest(): string
    {
        return ".Это все, что нужно для приготовления лайцепов";
    }
}

/**
 * EN: The Adapter makes the Adaptee's interface compatible with the Target's
 * interface.
 *
 * RU: Адаптер делает интерфейс Адаптируемого класса совместимым с целевым
 * интерфейсом.
 */
class Adapter extends Target
{
    private $adaptee;

    public function __construct(Adaptee $adaptee)
    {
        $this->adaptee = $adaptee;
    }

    public function request(): string
    {
        return "Адаптер: (ПЕРЕВЕДЕНО) " . strrev($this->adaptee->specificRequest());
    }
}

/**
 * EN: The client code supports all classes that follow the Target interface.
 *
 * RU: Клиентский код поддерживает все классы, использующие целевой интерфейс.
 */
function clientCode(Target $target)
{
    echo $target->request();
}
echo '<pre>';
echo "Клиент: Я прекрасно могу работать с целевыми объектами:\n";
$target = new Target();
clientCode($target);
echo "\n\n";

$adaptee = new Adaptee();
echo "Клиент: У адаптируемого класса странный интерфейс. Видите ли, я этого не понимаю:\n";
echo "Адаптируемый: " . $adaptee->specificRequest();
echo "\n\n";

echo "Клиент: Но я могу работать с ним через адаптер:\n";
$adapter = new Adapter($adaptee);
clientCode($adapter);

echo '</pre>';