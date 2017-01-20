<?php

namespace Simcafe\Tests\Unit;

use Simcafe\Tests\Unit\TestCase;
use Simcafe\Runner\Engine;
use Simcafe\Model\Shop;
use Simcafe\Model\Robot;
use Simcafe\Model\Coord;
use Simcafe\Model\Direction;
use Simcafe\Model\Command;

class EngineTest extends TestCase
{
  const WEIRED_FIXTURES = [
    [
      'init' => '1 2 N',
      'command' => 'RMLMLM',
      'steps' => [
        '1 2 E',
        '2 2 E',
        '2 2 N',
        '2 3 N',
        '2 3 W',
        '1 3 W',
      ],
      'final' => '1 3 W',
    ],
    [
      'init' => '3 4 E',
      'command' => 'RMRMMML',
      'steps' => [
        '3 4 S',
        '3 3 S',
        '3 3 W',
        '2 3 W',
        '1 3 W',
        '0 3 W',
        '0 3 S',
      ],
      'final' => '0 3 S',
    ]
  ];

  public function test_init() {
    $engine = $this->getEngine();

    $this->assertInstanceOf(Shop::class, $engine->getShop());
    $this->assertEquals('6 6', (string) $engine->getShop());

    foreach ($engine->getRobots() as $index => $robot) {
      $this->assertEquals(parent::FIXTURES[$index]['init'], (string) $robot);
    }
  }

  public function test_run() {
    $engine = $this->getEngine()->run();

    $this->assertTrue($engine->isDone());

    foreach ($engine->getRobots() as $index => $robot) {
      $this->assertEquals(parent::FIXTURES[$index]['final'], (string) $robot);
    }
  }

  /**
   * @expectedException \Simcafe\Exception\OverstepException
   */
  public function test_over_step() {
    $engine = new Engine($this->getShop(5, 5), $this->getRobots());
    $engine->run();
  }

  /**
   * @expectedException \Simcafe\Exception\CollisionException
   */
  public function test_collision() {
    $engine = new Engine($this->getShop(), $this->getWeirdRobots());
    $engine->run();
  }

  protected function getShop($width = 6, $length = 6) {
    return $this->shop ?: new Shop($width, $length);
  }

  protected function getEngine() {
    return $this->engine ?: new Engine($this->getShop(), $this->getRobots());
  }

  protected function getWeirdRobots() {
    $robots = [];
    foreach (self::WEIRED_FIXTURES as $index => $fixture) {
      $inits = explode(' ', $fixture['init']);

      $coord = new Coord((int) $inits[0], (int) $inits[1]);
      $direction = new Direction($inits[2]);
      $command = new Command($fixture['command']);

      $robots[$index] = new Robot($coord, $direction, $command);
    }

    return $robots;
  }
}