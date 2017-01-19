<?php

namespace Simcafe\Model;

use Simcafe\Interfaces\IDirection;

class Direction implements IDirection
{
  const North = 'N';
  const East  = 'E';
  const South = 'S';
  const West  = 'W';

  const Directions = [
    self::North => 1,
    self::East => 2,
    self::South => 3,
    self::West => 4
  ];

  private $direction;

  public function __construct($dir) {
    if (!array_key_exists($dir, self::Directions)) {
      throw new \UnexpectedValueException(" Invalid direction {$dir}!");
    }
    
    $this->direction = $dir;
  }

  public function turnLeft() {
    $next = (self::Directions[$this->direction] - 1) ?: 4;
    $this->direction = array_flip(self::Directions)[$next];
  }

  public function turnRight() {
    $next = self::Directions[$this->direction] + 1;
    $next = $next > 4 ? 0 : $next;
    $this->direction = array_flip(self::Directions)[$next];
  }

  public function __toString() {
    return $this->direction;
  }
}
