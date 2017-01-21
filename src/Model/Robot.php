<?php

namespace Simcafe\Model;

use Simcafe\Interfaces\IRobot;
use Simcafe\Interfaces\ICoord;
use Simcafe\Interfaces\IDirection;
use Simcafe\Interfaces\ICommand;

class Robot implements IRobot
{
  protected $coord;
  protected $direction;
  protected $command;

  protected $done = false;

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

  public function act() {
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

    if (!$this->command->next()) {
      $this->done = true;
    }

    return $this;
  }

  private function move() {
    $method = sprintf('move%s', Direction::DIRECTION_NAMES[(string) $this->direction]);

    if (method_exists($this, $method)) {
      $this->{$method}();
    } else {
      throw new \Exception("{$method} not existing on ".__CLASS__."!");
    }
  }

  protected function moveNorth() {
    $this->coord->incrementY();
  }

  protected function moveEast() {
    $this->coord->incrementX();
  }

  protected function moveSouth() {
    $this->coord->decrementY();
  }

  protected function moveWest() {
    $this->coord->decrementX();
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