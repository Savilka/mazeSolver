<?php

namespace App;
/**
 * Класс, используемый для представления объекта точки
 */
class Point
{
    /**
     * Координата по оси X
     * @var int
     */
    public int $x;
    /**
     * Координата по оси Y
     * @var int
     */
    public int $y;

    /**
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * Метод возращает уникальное строковое значение для каждой точки
     * @return string
     */
    public function getUniqId(): string
    {
        return $this->x . '.' . $this->y;
    }
}