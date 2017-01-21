<?php

namespace Simcafe\Runner;

use Simcafe\Interfaces\IRobot;
use Simcafe\Interfaces\IShop;
use Simcafe\Interfaces\IEngine;
use Simcafe\Exception\CollisionException;
use Simcafe\Exception\OverstepException;

class Engine implements IEngine
{
  private $shop;
  private $robots = [];
  private $robots_count;

  public function __construct(IShop $shop, array $robots) {
    $this->shop = $shop;
    $this->loadRobots($robots);
  }

  private function loadRobots(array $robots) {
    foreach ($robots as $robot) {
      $this->addRobot($robot);
    }
    $this->robots_count = count($this->robots);
  }

  private function addRobot(IRobot $robot) {
    $this->robots[] = $robot;
  }

  public function run() {
    while (!$this->isDone()) {
      foreach ($this->robots as $robot) {
        $robot->act();
        $this->overstepDetect();
        $this->collisionDetect();
      }
    }

    return $this;
  }

  public function isDone() {
    return array_reduce($this->robots, function(bool $carry, IRobot $robot) {
      return $carry && $robot->isDone();
    }, true);
  }

  public function overstepDetect() {
    foreach ($this->robots as $index => $robot) {
      if ($robot->getCoord()->getX() >= $this->shop->getWidth() ||
          $robot->getCoord()->getY() >= $this->shop->getLength()) {
        throw new OverstepException(sprintf('Robot #%d @ %s over step Shop %s!', $index, $robot, $this->shop));
      }
    }
  }

  public function collisionDetect() {
    $coords = array_map(function(IRobot $robot) {
      return (string) $robot->getCoord();
    }, $this->robots);

    if (count(array_unique($coords)) < $this->robots_count) {
      throw new CollisionException;
    }
  }

  public function result() {
    foreach ($this->robots as $robot) {
      echo (string) $robot . PHP_EOL;
    }
  }

  public function getShop() {
    return $this->shop;
  }

  public function getRobots() {
    return $this->robots;
  }
}