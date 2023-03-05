<?php

namespace App;

/**
 * Класс, используемый для хранения стоимости пути до определенной точки.
 * При необходимости, можно модифицировать для нахождения кратчайшего пути
 */
class MazeNode
{
    /**
     * Стоимость прохода до точки
     * @var int
     */
    public int $cost;
    /**
     * Координаты точки
     * @var Point
     */
    public Point $point;

    /**
     * @param Point $point
     * @param int $cost
     */
    public function __construct(Point $point, int $cost)
    {
        $this->cost = $cost;
        $this->point = $point;
    }
}