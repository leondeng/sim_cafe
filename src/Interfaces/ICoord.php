<?php

namespace Simcafe\Interfaces;

interface ICoord
{
  public function incrementX();
  public function decrementX();
  public function incrementY();
  public function decrementY();
  public function getX();
  public function getY();
}