<?php

require 'vendor/autoload.php';

use Garbim\Notification\Factory\NotificationEmail;
use Garbim\Notification\Factory\NotificationTelegram;

$title = "Novas Promoções!";
$message = "Venha conferir nossas novas promoções.";

$listEmails = [
  'garbim7@gmail.com',
];
$listChats = [
  '1122848940'
];

$listDevices = ['11947347079'];
try {

  $destinationEmail = new NotificationEmail($title, $message, $listEmails);
  $destinationEmail->send();
  $destinationTelegram = new NotificationTelegram($title, $message, $listEmails);
  $destinationTelegram->send();

  //$destinationFirebase->execute($notification, $listDevices);
} catch (\InvalidArgumentException $th) {
  echo $th->getMessage() . "\n";
}
