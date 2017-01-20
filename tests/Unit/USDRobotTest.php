<?php

namespace Simcafe\Tests\Unit;

use Simcafe\Tests\Unit\TestCase;
use Simcafe\Model\USDRobot;
use Simcafe\Model\Coord;
use Simcafe\Model\Direction;
use Simcafe\Model\Command;

class USDRobotTest extends TestCase
{
  const FIXTURES = [
    [
      'init' => '1 2 N',
      'command' => 'LMLMLMLMM',
      'steps' => [
        '1 2 W',
        '0 2 W',
        '0 2 S',
        '0 3 S',
        '0 3 E',
        '1 3 E',
        '1 3 N',
        '1 2 N',
        '1 1 N',
      ],
      'final' => '1 1 N',
    ],
    [
      'init' => '3 3 E',
      'command' => 'MLMLMRMRMRRM',
      'steps' => [
        '4 3 E',
        '4 3 N',
        '4 2 N',
        '4 2 W',
        '3 2 W',
        '3 2 N',
        '3 1 N',
        '3 1 E',
        '4 1 E',
        '4 1 S',
        '4 1 W',
        '3 1 W',
      ],
      'final' => '3 1 W',
    ],
    [
      'init' => '1 2 N',
      'command' => 'M',
      'steps' => [
        '1 1 N',
      ],
      'final' => '1 1 N',
    ]
  ];

  protected function getRobots() {
    if (empty($this->robots)) {
      foreach (self::FIXTURES as $index => $fixture) {
        $inits = explode(' ', $fixture['init']);

        $coord = new Coord((int) $inits[0], (int) $inits[1]);
        $direction = new Direction($inits[2]);
        $command = new Command($fixture['command']);

        $this->robots[$index] = new USDRobot($coord, $direction, $command);
      }
    }

    return $this->robots;
  }

  public function test_move_north() {
    $robot = $this->getRobots()[2];
    $this->assertEquals(self::FIXTURES[2]['command'], (string) $robot->getCommand());
    $this->assertEquals(self::FIXTURES[2]['steps'][0], (string) $robot->action());
  }

  public function test_action_and_is_done() {
    foreach ($this->getRobots() as $index => $robot) {
      foreach (self::FIXTURES[$index]['steps'] as $step) {
        $this->assertEquals($step, (string) $robot->action());
      }
      $this->assertTrue($robot->isDone());
    }
  }

}