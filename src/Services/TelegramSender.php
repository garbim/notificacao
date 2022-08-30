<?php

namespace Garbim\Notification\Services;

use Garbim\Notification\Interfaces\SenderInterface;
use Garbim\Notification\Entity\InputNotification;
use InvalidArgumentException;

class TelegramSender implements SenderInterface
{
  protected string $bot = 'bot0000000000:aaaaaaaaaaaaa_000000-a0a0a0a0a0a0a0';
  protected string $urlBase = 'https://api.telegram.org/';
  protected array $from;
  protected string $message;

  public function __construct(string $message, array $from)
  {
    $this->message = $message;
    $this->from = $from;
  }

  public function validate(): bool|InvalidArgumentException
  {
    foreach ($this->from as $from) {
      $this->validateChannel($from);
    }
    return true;
  }

  protected function validateChannel($channel): bool|InvalidArgumentException
  {
    $valid = filter_var($channel, FILTER_VALIDATE_INT);
    if (!$valid) {
      throw new InvalidArgumentException('channel ' . $channel  . ' is invalid');
    }
    return $valid;
  }


  public function send(): bool
  {
    $website = $this->urlBase . $this->bot;
    $params = [
      'chat_id' => implode(',', $this->from),
      'text' => $this->message,
    ];
    $ch = curl_init($website . '/sendMessage');
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    var_dump($result);
    return $result ? true : false;
  }
}
