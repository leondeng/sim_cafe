<?php

namespace Simcafe\Tests\Unit\Model;

use Simcafe\Tests\Unit\TestCase;
use Simcafe\Model\Direction;

class DirectionTest extends TestCase
{
  public function test_init() {
    $dir = new Direction('N');
    $this->assertEquals(Direction::North, (string) $dir);
  }

  /**
   * @expectedException UnexpectedValueException
   */
  public function test_init_invalid() {
    $dir = new Direction('invalid');    
  }

  public function test_turn_left() {
    $dir = new Direction('N');
    $dir->turnLeft();
    $this->assertEquals(Direction::West, (string) $dir);
    $dir->turnLeft();
    $this->assertEquals(Direction::South, (string) $dir);
    $dir->turnLeft();
    $this->assertEquals(Direction::East, (string) $dir);
  }

  public function test_turn_right() {
    $dir = new Direction('N');
    $dir->turnRight();
    $this->assertEquals(Direction::East, (string) $dir);
    $dir->turnRight();
    $this->assertEquals(Direction::South, (string) $dir);
    $dir->turnRight();
    $this->assertEquals(Direction::West, (string) $dir);
  }
}