<?php

namespace Simcafe\Model;

use Simcafe\Interfaces\IShop;

class Shop implements IShop
{
  private $width;
  private $length;

  public function __construct(int $width, int $length) {
    $this->width = $width;
    $this->length = $length;
  }

  public function getWidth() {
    return $this->width;
  }

  public function getLength() {
    return $this->length;
  }

  public function __toString() {
    return sprintf('%d %d', $this->width, $this->length);
  }
}