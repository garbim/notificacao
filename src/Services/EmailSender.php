<?php

namespace Garbim\Notification\Services;

use Garbim\Notification\Interfaces\SenderInterface;
use Garbim\Notification\Entity\InputNotification;
use InvalidArgumentException;

class EmailSender implements SenderInterface
{
  protected array $from;
  protected string $title;
  protected string $message;

  public function __construct(string $title, string $message, array $from)
  {
    $this->title = $title;
    $this->message = $message;
    $this->from = $from;
  }

  public function validate(): bool|InvalidArgumentException
  {
    foreach ($this->from as $from) {
      $this->validateEmail($from);
    }
    return true;
  }

  protected function validateEmail($email): bool|InvalidArgumentException
  {
    $valid = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!$valid) {
      throw new InvalidArgumentException('From is invalid');
    }
    return $valid;
  }


  public function send(): bool
  {
    return mail(implode(',', $this->from), $this->title, $this->message);
  }
}
