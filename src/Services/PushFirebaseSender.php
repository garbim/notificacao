<?php

namespace Garbim\Notification\Services;

use Garbim\Notification\Interfaces\SenderInterface;
use Garbim\Notification\Entity\InputNotification;

class PushFirebaseSender implements SenderInterface
{

  private $firebaseMessage;
  private $consumer;
  protected string $title;
  protected string $message;

  public function __construct(string $title, string $message, array $from)
  {
    $this->consumer = new Consumer();
    $this->consumer->setApiKey("FCM-SERVER-KEY");
    $this->consumer->injectGuzzleHttpClient(new GuzzleHttpClient());
    $this->firebaseMessage = new Message();
    $this->title = $title;
    $this->message = $message;
    $this->setFrom($from);
  }


  public function setFrom(array $from): void
  {
    foreach ($from as $to) {
      $this->firebaseMessage->addRecipient(new Device($to));
    }
  }


  public function send(): bool
  {
    $this->firebaseMessage->setNotification(new Notification($this->title, $this->message));
    $response = $this->consumer->ship($this->firebaseMessage);
    $responseData = $response->json();
    return $responseData ? true : false;
  }
}
