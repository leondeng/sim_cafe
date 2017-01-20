<?php

namespace Simcafe\Tests\Unit\Model;

use Simcafe\Tests\Unit\TestCase;
use Simcafe\Model\Robot;
use Simcafe\Model\Coord;
use Simcafe\Model\Direction;
use Simcafe\Model\Command;

class RobotTest extends TestCase
{
  const FIXTURES = [
    [
      'init' => '1 2 N',
      'command' => 'LMLMLMLMM',
      'steps' => [
        '1 2 W',
        '0 2 W',
        '0 2 S',
        '0 1 S',
        '0 1 E',
        '1 1 E',
        '1 1 N',
        '1 2 N',
        '1 3 N',
      ],
    ],
    [
      'init' => '3 3 E',
      'command' => 'MLMLMRMRMRRM',
      'steps' => [
        '4 3 E',
        '4 3 N',
        '4 4 N',
        '4 4 W',
        '3 4 W',
        '3 4 N',
        '3 5 N',
        '3 5 E',
        '4 5 E',
        '4 5 S',
        '4 5 W',
        '3 5 W',
      ],
    ]
  ];

  private $robots = [];

  public function test_init() {
    foreach ($this->getRobots() as $index => $robot) {
      $this->assertEquals(self::FIXTURES[$index]['init'], (string) $robot);
      $this->assertEquals(self::FIXTURES[$index]['command'], $robot->getCommand());
    }
  }

  public function test_action() {
    foreach ($this->getRobots() as $index => $robot) {
      foreach (self::FIXTURES[$index]['steps'] as $step) {
        $this->assertEquals($step, (string) $robot->action());
      }
    }
  }

  private function getRobots() {
    if (empty($this->robots)) {
      foreach (self::FIXTURES as $index => $fixture) {
        $inits = explode(' ', $fixture['init']);

        $coord = new Coord((int) $inits[0], (int) $inits[1]);
        $direction = new Direction($inits[2]);
        $command = new Command($fixture['command']);

        $this->robots[$index] = new Robot($coord, $direction, $command);
      }
    }

    return $this->robots;
  }

}