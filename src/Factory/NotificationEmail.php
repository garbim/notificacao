<?php

namespace Garbim\Notification\Factory;

use Garbim\Notification\Interfaces\SenderInterface;
use Garbim\Notification\Services\EmailSender;

class NotificationEmail extends NotificationFactory
{

  private string $title;
  private string $message;
  private array $from;
  public function __construct(string $title, string $message, array $from)
  {
    $this->title = $title;
    $this->message = $message;
    $this->from = $from;
  }

  public function getSendMethod(): SenderInterface
  {
    return new EmailSender($this->title, $this->message, $this->from);
  }
}
