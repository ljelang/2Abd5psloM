<?php
use Symfony\Bridge\Twig\Mime\BodyRenderer;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Mailer\EventListener\MessageListener;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Twig\Environment as TwigEnvironment;

$twig = new TwigEnvironment(...);
$messageListener = new MessageListener(null, new BodyRenderer($twig));

$eventDispatcher = new EventDispatcher();
$eventDispatcher->addSubscriber($messageListener);

$transport = Transport::fromDsn('smtp://localhost', $eventDispatcher);
$mailer = new Mailer($transport, null, $eventDispatcher);

$email = (new TemplatedEmail())
    // ...
    ->htmlTemplate('email/signup.html')
    ->context([
        'expiration_date' => new \DateTime('+7 days'),
        'username' => 'foo',
    ])
;
$mailer->send($email);