<?php

namespace Garbim\Notification\Factory;

use Garbim\Notification\Interfaces\SenderInterface;
use InvalidArgumentException;

abstract class NotificationFactory
{

  abstract public function getSendMethod(): SenderInterface;

  public function send(): mixed
  {
    try {
      $notificationSender = $this->getSendMethod();
      $notificationSender->validate();
      return $notificationSender->send();
    } catch (InvalidArgumentException $th) {
      throw new InvalidArgumentException($th->getMessage());
    }
  }
}
