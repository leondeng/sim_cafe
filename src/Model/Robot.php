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

  private $done = false;

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
    if ($this->done) {
      return $this;
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

    if (! $this->command->next()) {
      $this->done = true;
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

  public function isDone() {
    return $this->done;
  }

  public function getCoord() {
    return $this->coord;
  }

  public function getDirection() {
    return $this->direction;
  }

  public function __toString() {
    return sprintf('%s %s', $this->coord, $this->direction);
  }

} 