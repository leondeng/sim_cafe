<?php

namespace Simcafe\Model;

use Simcafe\Interfaces\IRobot;
use Simcafe\Interfaces\ICoord;
use Simcafe\Interfaces\IDirection;
use Simcafe\Interfaces\ICommand;

class Robot implements IRobot
{
  private $coord;
  private $dirction;
  private $command;

  public function __construct(ICoord $coord,
                              IDirection $direction,
                              ICommand $command) {
    $this->coord = $coord;
    $this->direction = $direction;
    $this->command = $command;
  }

  public function getCommand() {
    return $this->command;
  }

  public function action() {
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
      case Direction::NORTH:
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