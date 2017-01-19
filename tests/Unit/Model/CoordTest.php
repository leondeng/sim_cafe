<?php

namespace Simcafe\Tests\Unit\Model;

use Simcafe\Tests\Unit\TestCase;
use Simcafe\Model\Coord;

class CoordTest extends TestCase
{
  public function test_init() {
    $coord = new Coord(3, 5);
    $this->assertEquals('3 5', (string) $coord);
  }
}
