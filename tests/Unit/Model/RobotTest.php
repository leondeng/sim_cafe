<?php

namespace Simcafe\Tests\Unit\Model;

use Simcafe\Tests\Unit\TestCase;
use Simcafe\Model\Robot;

class RobotTest extends TestCase
{
  public function test_init() {
    $init = '1 2 N';
    $command = 'LMLMLMLMM';

    $robot = new Robot($init, $command);
    $this->assertEquals($init, (string) $robot);
    $this->assertEquals($command, $robot->getCommand());
  }

  public function test_action() {
    $init = '1 2 N';
    $command = 'LMLMLMLMM';

    $robot = new Robot($init, $command);
    $this->assertEquals('1 2 W', (string) $robot->action());
  }

}