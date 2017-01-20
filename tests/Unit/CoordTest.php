<?php

namespace Simcafe\Tests\Unit;

use Simcafe\Tests\Unit\TestCase;
use Simcafe\Model\Coord;

class CoordTest extends TestCase
{
  public function test_init() {
    $coord = new Coord(3, 5);
    $this->assertEquals('3 5', (string) $coord);
  }

  public function test_accessors() {
    $coord = new Coord(3, 5);
    $this->assertEquals(3, $coord->getX());
    $this->assertEquals(5, $coord->getY());
  }
}
