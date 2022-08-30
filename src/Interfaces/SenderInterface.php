<?php

namespace Garbim\Notification\Interfaces;

use Garbim\Notification\Entity\InputNotification;
use InvalidArgumentException;

interface SenderInterface
{
  public function validate(): bool|InvalidArgumentException;
  public function send(): bool;
}
