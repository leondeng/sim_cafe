<?php

namespace Simcafe\Model;

use Simcafe\Interfaces\ICoord;
use Simcafe\Interfaces\IDirection;

class Robot implements IRobot
{
  const TURN_LEFT  = 'L';
  const TURN_RIGHT = 'R';
  const MOVE       = 'M';

  public function __construct(ICoord $cord, IDirection $dirction) {

  }

} 