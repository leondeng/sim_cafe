<?php

namespace Simcafe\Model;

use Simcafe\Interfaces\ICommand;

class Command implements ICommand
{
  const LEFT  = 'L';
  const RIGHT = 'R';
  const MOVE  = 'M';

  const ACTIONS = [
    self::LEFT,
    self::RIGHT,
    self::MOVE
  ];

  private $actions = [];
  private $action_length = 0;
  private $cur = 0;

  public function __construct(string $command) {
    $this->actions = str_split($command);

    $this->validateCommand();

    $this->action_length = count($this->actions);
  }

  private function validateCommand() {
    $invalid_actions = array_diff(array_unique($this->actions), self::ACTIONS);

    if (!empty($invalid_actions)) {
      throw new \UnexpectedValueException(sprintf('Invalid action(s): %s', implode(' ', $invalid_actions)));
    }
  }

  public function getAction() {
    if ($this->cur >= $this->action_length) {
      return false;
    }

    return $this->actions[$this->cur];
  }

  public function next() {
    if (++$this->cur >= $this->action_length) {
      return false;
    }

    return $this;
  }

  public function getLength() {
    return $this->action_length;
  }

  public function __toString() {
    return implode('', $this->actions);
  }
}