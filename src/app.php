<?php

require_once(__DIR__.'/../vendor/autoload.php');

use Simcafe\Model\Shop;
use Simcafe\Model\USDRobot;
use Simcafe\Model\Coord;
use Simcafe\Model\Direction;
use Simcafe\Model\Command;
use Simcafe\Runner\Engine;
use Simcafe\Exception\CollisionException;
use Simcafe\Exception\NegativestepException;
use Simcafe\Exception\OverstepException;

$lines = array_map(function($line) {
  return rtrim($line);
}, file(__DIR__.'/input.txt'));

$size = explode(' ', array_shift($lines));
$shop = new Shop((int) $size[0], (int) $size[1]);

$robots = [];

foreach (array_chunk($lines, 2) as $fixture) {
  $inits = explode(' ', $fixture[0]);
  $coord = new Coord((int) $inits[0], (int) $inits[1]);
  $direction = new Direction($inits[2]);
  $command = new Command($fixture[1]);
  $robots[] = new USDRobot($coord, $direction, $command);
}

$engine = new Engine($shop, $robots);

try {
  $engine->run();
  $engine->result();
} catch (CollisionException $e) {
  echo 'Robot Collision Detected';
} catch (OverstepException $e) {
  echo 'Robot Overstep Detected';
} catch (NegativestepException $e) {
  echo 'Robot Negative Step Detected';
} catch (\Exception $e) {
  throw $e;
}
