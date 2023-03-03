<?php

namespace App;

use Exception;

class Maze
{
    private array $data;
    private Point $start;
    private Point $finish;

    /**
     * @throws Exception
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        $counterForStart = 0;
        $counterForFinish = 0;
        foreach ($data as $i => $row) {
            foreach ($row as $j => $element) {
                if ($element == -1) {
                    $counterForStart++;
                    if ($counterForStart > 1) break 2;
                    $this->start = new Point($j, $i);
                }
                if ($element == 10) {
                    $counterForFinish++;
                    if ($counterForFinish > 1) break 2;
                    $this->finish = new Point($j, $i);
                }
            }
        }

        if ($counterForStart > 1 || $counterForFinish > 1) {
            throw new Exception('Больше одной точки старта или финиша');
        }

        if (!isset($this->finish) || !isset($this->start)) {
            throw new Exception('Не заданы точки начала или финиша');
        }
    }

    public function findPathCost(): int
    {
        $candidates = [];
        $visited = [];
        $nodes = [];

        $nodes[$this->start->getUniqId()] = new MazeNode($this->start, 0);

        $candidates[$this->start->getUniqId()] = $this->start;

        while (true) {
            $next = null;
            $bestCost = 100;
            foreach ($candidates as $candidate) {
                if ($nodes[$candidate->getUniqId()]->cost < $bestCost) {
                    $bestCost = $nodes[$candidate->getUniqId()]->cost;
                    $next = $candidate;
                }
            }

            if ($next == null) {
                break;
            }

            if ($next == $this->finish) {
                break;
            }

            $nearbyNodes = $this->getNearbyNodes($next);

            foreach ($nearbyNodes as $nearbyNode) {
                $currCost = $nodes[$next->getUniqId()]->cost + $this->data[$nearbyNode->y][$nearbyNode->x];
                if (!array_key_exists($nearbyNode->getUniqId(), $nodes) || $nodes[$nearbyNode->getUniqId()]->cost > $currCost) {
                    $nodes[$nearbyNode->getUniqId()] = new MazeNode($next, $currCost);
                }
                if (!in_array($nearbyNode, $visited)) {
                    $candidates[$nearbyNode->getUniqId()] = $nearbyNode;
                }
            }

            unset($candidates[$next->getUniqId()]);
            $visited[] = $next;
        }


        if (isset($nodes[$this->finish->getUniqId()])) {
            return $nodes[$this->finish->getUniqId()]->cost - 10;
        } else {
            return -1;
        }

    }

    private function getNearbyNodes(Point $point): array
    {
        $nodes = [
            new Point($point->x - 1, $point->y),
            new Point($point->x, $point->y - 1),
            new Point($point->x + 1, $point->y),
            new Point($point->x, $point->y + 1),
        ];
        foreach ($nodes as $i => $node) {
            if (!$this->insideMaze($node) || $this->isWall($node)) {
                unset($nodes[$i]);
            }
        }
        return $nodes;
    }

    private function isWall(Point $point): bool
    {
        if ($this->insideMaze($point) && $this->data[$point->y][$point->x] == 0) return true;
        return false;
    }

    private function insideMaze(Point $point): bool
    {
        if ($point->x >= 0 && $point->y >= 0) return true;
        else return false;
    }
}