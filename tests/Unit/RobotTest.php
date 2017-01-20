<?php

namespace Simcafe\Tests\Unit;

use Simcafe\Tests\Unit\TestCase;

class RobotTest extends TestCase
{
  public function test_init() {
    foreach ($this->getRobots() as $index => $robot) {
      $this->assertEquals(parent::FIXTURES[$index]['init'], (string) $robot);
      $this->assertEquals(parent::FIXTURES[$index]['command'], $robot->getCommand());
    }
  }

  public function test_action_and_is_done() {
    foreach ($this->getRobots() as $index => $robot) {
      foreach (parent::FIXTURES[$index]['steps'] as $step) {
        $this->assertEquals($step, (string) $robot->action());
      }
      $this->assertTrue($robot->isDone());
    }
  }

}