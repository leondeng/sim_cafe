<?php

namespace Simcafe\Tests\Unit;

use Simcafe\Tests\Unit\TestCase;
use Simcafe\Model\Direction;

class DirectionTest extends TestCase
{
  public function test_init() {
    $dir = new Direction('N');
    $this->assertEquals(Direction::NORTH, (string) $dir);
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
    $this->assertEquals(Direction::WEST, (string) $dir);
    $dir->turnLeft();
    $this->assertEquals(Direction::SOUTH, (string) $dir);
    $dir->turnLeft();
    $this->assertEquals(Direction::EAST, (string) $dir);
  }

  public function test_turn_right() {
    $dir = new Direction('N');
    $dir->turnRight();
    $this->assertEquals(Direction::EAST, (string) $dir);
    $dir->turnRight();
    $this->assertEquals(Direction::SOUTH, (string) $dir);
    $dir->turnRight();
    $this->assertEquals(Direction::WEST, (string) $dir);
  }
}