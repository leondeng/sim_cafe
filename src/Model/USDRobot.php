<?php

namespace Simcafe\Model;

/**
 * Up Side Dwon Robot, who walks in a grid where Y increase when going South
 */
class USDRobot extends Robot
{
  protected function move() {
    switch ((string) $this->direction) {
      case Direction::NORTH:
        $this->coord->decrementY();
        break;
      case Direction::EAST:
        $this->coord->incrementX();
        break;
      case Direction::SOUTH:
        $this->coord->incrementY();
        break;
      case Direction::WEST:
        $this->coord->decrementX();
        break;
    }
  }
}