<?php

namespace Simcafe\Interfaces;

interface IRobot
{
  public function getCommand();
  public function action();
  public function isDone();
  public function getCoord();
  public function getDirection();
}