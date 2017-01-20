<?php

namespace Simcafe\Model;

use Simcafe\Interfaces\ICoord;

class Coord implements ICoord
{
  private $x;
  private $y;

  public function __construct(int $x, int $y) {
    $this->x = $x;
    $this->y = $y;
  }

  public function incrementX() {
    $this->x++;
  }

  public function incrementY() {
    $this->y++;
  }

  public function decrementX() {
    $this->x--;
  }

  public function decrementY() {
    $this->y--;
  }

  public function getX() {
    return $this->x;
  }

  public function getY() {
    return $this->y;
  }

  public function __toString() {
    return sprintf('%d %d', $this->x, $this->y);
  }
}