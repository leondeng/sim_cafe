<?php

namespace Simcafe\Model;

/**
 * Up Side Dwon Robot, who walks in a grid where Y increase when going South
 */
class USDRobot extends Robot
{
  protected function moveNorth() {
    $this->coord->decrementY();
  }

  protected function moveSouth() {
    $this->coord->incrementY();
  }
}