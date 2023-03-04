<?php

use App\Maze;
use PHPUnit\Framework\TestCase;

class MazeTest extends TestCase
{
    public function constructProvider()
    {
        return [
            // Лабиринт без старта и финиша
            ['data' => [
                [0, 0, 0, 0],
                [0, 0, 0, 0],
                [0, 0, 0, 0],
                [0, 0, 0, 0]
            ],
                'expectMess' => 'Не заданы точки начала или финиша'
            ],
            // Лабиринт с одним стартом без финиша
            ['data' => [
                [0, 0, 0, 0],
                [0, -1, 0, 0],
                [0, 0, 0, 0],
                [0, 0, 0, 0]
            ],
                'expectMess' => 'Не заданы точки начала или финиша'
            ],
            // Лабиринт с одним финишем без старта
            ['data' => [
                [0, 0, 0, 0],
                [0, 0, 0, 0],
                [0, 0, 10, 0],
                [0, 0, 0, 0]
            ],
                'expectMess' => 'Не заданы точки начала или финиша'
            ],
            // Лабиринт с двумя стартами без финиша
            ['data' => [
                [0, 0, 0, 0],
                [0, -1, -1, 0],
                [0, 0, 0, 0],
                [0, 0, 0, 0]
            ],
                'expectMess' => 'Больше одной точки старта или финиша'
            ],
            // Лабиринт с двумя финишами без старта
            ['data' => [
                [0, 0, 0, 0],
                [0, 0, 10, 0],
                [0, 0, 10, 0],
                [0, 0, 0, 0]
            ],
                'expectMess' => 'Больше одной точки старта или финиша'
            ],
            // Лабиринт с двумя финишами и одним стартом
            ['data' => [
                [0, 0, 0, 0],
                [0, -1, 10, 0],
                [0, 0, 10, 0],
                [0, 0, 0, 0]
            ],
                'expectMess' => 'Больше одной точки старта или финиша'
            ],
            // Лабиринт с двумя стартами и одним финишем
            ['data' => [
                [0, 0, 0, 0],
                [0, -1, -1, 0],
                [0, 0, 10, 0],
                [0, 0, 0, 0]
            ],
                'expectMess' => 'Больше одной точки старта или финиша'
            ],
            // Лабиринт с двумя стартами и двумя финишами
            ['data' => [
                [0, 0, 0, 0],
                [0, -1, -1, 0],
                [0, 10, 10, 0],
                [0, 0, 0, 0]
            ],
                'expectMess' => 'Больше одной точки старта или финиша'
            ],


        ];
    }

    /**
     * @dataProvider constructProvider
     */
    public function test__construct(array $data, string $expected)
    {
        $this->expectExceptionMessage($expected);
        new Maze($data);
    }

    public function mazeProvider()
    {
        return [
            [
                'data' => [
                    [0, 0, 0, 0],
                    [0, -1, 10, 0],
                    [0, 0, 0, 0],
                    [0, 0, 0, 0]
                ],
                'expectCost' => 0
            ],
            [
                'data' => [
                    [0, 0, 0, 0],
                    [0, -1, 1, 0],
                    [0, 0, 10, 0],
                    [0, 0, 0, 0]
                ],
                'expectCost' => 1
            ],
            [
                'data' => [
                    [0, 0, 0, 0],
                    [0, -1, 1, 0],
                    [0, 1, 10, 0],
                    [0, 0, 0, 0]
                ],
                'expectCost' => 1
            ],
            [
                'data' => [
                    [0, 0, 0, 0],
                    [0, -1, 1, 0],
                    [0, 2, 10, 0],
                    [0, 0, 0, 0]
                ],
                'expectCost' => 1
            ],
            [
                'data' => [
                    [0, 0, 0, 0],
                    [0, -1, 10, 0],
                    [0, 0, 0, 0],
                    [0, 0, 0, 0]
                ],
                'expectCost' => 0
            ],
            [
                'data' => [
                    [0, 0, 0, 0],
                    [0, -1, 1, 1],
                    [0, 2, 0, 9],
                    [0, 3, 3, 10]
                ],
                'expectCost' => 8
            ],
            [
                'data' => [
                    [-1, 1, 1, 1],
                    [1, 1, 1, 1],
                    [1, 1, 1, 1],
                    [1, 1, 1, 10]
                ],
                'expectCost' => 5
            ],
            [
                'data' => [
                    [0, 0, 0, 0],
                    [0, -1, 0, 0],
                    [0, 0, 10, 0],
                    [0, 0, 0, 0]
                ],
                'expectCost' => -1
            ],
        ];
    }

    /**
     * @dataProvider mazeProvider
     */
    public function testFindPathCost(array $data, int $expected)
    {
        try {
            $mazeSolver = new Maze($data);
        } catch (Exception $e) {
            return;
        }

        $this->assertEquals($mazeSolver->findPathCost(), $expected);
    }
}
