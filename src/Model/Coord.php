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
}