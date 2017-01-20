<?php

namespace Simcafe\Interfaces;

interface IEngine
{
  public function run();
  public function overstepDetect();
  public function collisionDetect();
  public function isDone();
}