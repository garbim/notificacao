<?php

namespace Garbim\Notification\Factory;

use Garbim\Notification\Interfaces\SenderInterface;

class NotificationEmail extends NotificationFactory
{

  private string $title;
  private string $message;
  public function __construct(string $title, string $message)
  {
    $this->title = $title;
    $this->message = $message;
  }

  public function getSendMethod(): SenderInterface
  {
    return new EmailSender($this->title, $this->message);
  }
}
