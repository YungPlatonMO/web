<?php

class NumbersSquared implements Iterator{
    private int $start;
    private int $end;
    private int $current;

    public function __construct(int $start, int $end)
    {
        $this->start = $start;
        $this->end = $end;
        $this->rewind();
    }
    public function rewind(): void
    {
        $this->current = $this->start;
    }

    public function valid(): bool
    {
        return $this->current <= $this->end;
    }

    public function next(): void
    {
        $this->current++;
    }

    public function key(): int
    {
        return $this->current;
    }

    public function current(): int
    {
        return $this->current ** 2;
    }
}
echo '<pre>';
// Создаем объект класса NumbersSquared от 3 до 7
$obj = new NumbersSquared(3, 7);

foreach ($obj as $num => $square) {
    echo "Квадрат числа $num = $square\n";
}
echo '</pre>';

