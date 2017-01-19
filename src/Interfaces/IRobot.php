<?php

namespace Simcafe\Interfaces;

interface IRobot
{
  public function action($action);
  public function turnLeft();
  public function turnRight();
  public function step();
  public function report();
}