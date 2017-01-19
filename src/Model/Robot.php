<?php

namespace Simcafe\Model;

use Simcafe\Interfaces\IRobot;

class Robot implements IRobot
{
  private $coord;
  private $dirction;
  private $command;

  public function __construct(string $init, string $command) {
    $inits = explode(' ', $init);
    $this->coord = new Coord((int) $inits[0], (int) $inits[1]);

    $this->direction = new Direction($inits[2]);

    $this->command = new Command($command);
  }

  public function getCommand() {
    return $this->command;
  }

  public function action() {
    $action = $this->command->getAction();

    if (! $action) {
      return;
    }

    switch ($this->command->getAction()) {
      case Command::LEFT:
        $this->direction->turnLeft();
        break;
      case Command::RIGHT:
        $this->direction->turnRight();
        break;
      case Command::MOVE:
        $this->move();
        break;
    }

    return $this;
  }

  private function move() {
    switch ((string) $this->direction) {
      case Direction::North:
        $this->coord->incrementY();
        break;
      case Direction::EAST:
        $this->coord->incrementX();
        break;
      case Direction::SOUTH:
        $this->coord->decrementY();
        break;
      case Direction::WEST:
        $this->coord->decrementX();
        break;
    }
  }

  public function __toString() {
    return sprintf('%s %s', $this->coord, $this->direction);
  }

} 