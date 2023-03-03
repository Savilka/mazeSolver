<?php

namespace App;

class MazeNode
{
    public int $cost;
    public ?Point $point;

    public function __construct(?Point $point, int $cost)
    {
        $this->cost = $cost;
        $this->point = $point;
    }
}