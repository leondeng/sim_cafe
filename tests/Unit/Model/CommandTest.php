<?php

namespace Simcafe\Tests\Unit\Model;

use Simcafe\Tests\Unit\TestCase;
use Simcafe\Model\Command;

class CommandTest extends TestCase
{
  public function test_init() {
    $input = 'LMLMLMLMM';
    $command = new Command($input);
    $this->assertEquals($input, (string) $command);
    $this->assertEquals(9, $command->getLength());
  }

  /**
   * @expectedException UnexpectedValueException
   */
  public function test_init_invalid() {
    $input = 'INVALID';
    $command = new Command($input);
  }

  public function test_get_action() {
    $input = 'LMLRM';
    $command = new Command($input);

    foreach (str_split($input) as $action) {
      $this->assertEquals($action, $command->getAction());
    }

    $this->assertFalse($command->getAction());    
  }
}