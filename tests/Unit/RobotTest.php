<?php

namespace Simcafe\Tests\Unit;

use Simcafe\Tests\Unit\TestCase;
use Simcafe\Model\Robot;
use Simcafe\Model\Coord;
use Simcafe\Model\Direction;
use Simcafe\Model\Command;

class RobotTest extends TestCase
{
  const NEGATIVE_FIXTURE = [
    'init' => '0 1 W',
    'command' => 'M',
  ];

  public function test_init() {
    foreach ($this->getRobots() as $index => $robot) {
      $this->assertEquals(parent::FIXTURES[$index]['init'], (string) $robot);
      $this->assertEquals(parent::FIXTURES[$index]['command'], $robot->getCommand());
    }
  }

  public function test_action_and_is_done() {
    foreach ($this->getRobots() as $index => $robot) {
      foreach (parent::FIXTURES[$index]['steps'] as $step) {
        $this->assertEquals($step, (string) $robot->act());
      }
      $this->assertTrue($robot->isDone());
    }
  }

  /**
   * @expectedException \Simcafe\Exception\NegativestepException
   */
  public function test_negative_move() {
    $inits = explode(' ', self::NEGATIVE_FIXTURE['init']);

    $coord = new Coord((int) $inits[0], (int) $inits[1]);
    $direction = new Direction($inits[2]);
    $command = new Command(self::NEGATIVE_FIXTURE['command']);

    $robot = new Robot($coord, $direction, $command);
    $robot->act();
  }

}