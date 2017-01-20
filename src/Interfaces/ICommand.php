<?php

namespace Simcafe\Interfaces;

interface ICommand
{
  public function getAction();
  public function next();
  public function getLength();
}