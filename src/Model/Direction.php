<?php

namespace Simcafe\Model;

use Simcafe\Interfaces\IDirection;

class Direction implements IDirection
{
  const NORTH = 'N';
  const EAST  = 'E';
  const SOUTH = 'S';
  const WEST  = 'W';

  const DIRECTIONS = [
    self::NORTH => 1,
    self::EAST => 2,
    self::SOUTH => 3,
    self::WEST => 4,
  ];

  const DIRECTION_NAMES = [
    self::NORTH => 'North',
    self::EAST => 'East',
    self::SOUTH => 'South',
    self::WEST => 'West',
  ];

  private $direction;

  public function __construct($dir) {
    if (!array_key_exists($dir, self::DIRECTIONS)) {
      throw new \UnexpectedValueException(" Invalid direction {$dir}!");
    }
    
    $this->direction = $dir;
  }

  public function turnLeft() {
    $next = (self::DIRECTIONS[$this->direction] - 1) ?: 4;
    $this->direction = array_flip(self::DIRECTIONS)[$next];
  }

  public function turnRight() {
    $next = self::DIRECTIONS[$this->direction] + 1;
    $next = $next > 4 ? 1 : $next;
    $this->direction = array_flip(self::DIRECTIONS)[$next];
  }

  public function __toString() {
    return $this->direction;
  }
}
