<?php

namespace App\EventSubscriber;

use PharIo\Manifest\Email;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\event\MessageEvent;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Event\WorkerMessageFailedEvent;

class ExceptionSubscriber implements EventSubscriberInterface
{
	//Video grafikart https://www.youtube.com/watch?v=0BWU-liZIU4
	
	
	private $mailer;
	
	public function __construct(MailerInterface $mailer)
	{
		$this->mailer = $mailer;
	}
	
	public static function getSubscribedEvents()
    {
        return [
            WorkerMessageFailedEvent::class => 'onMessageFailed',
        ];
    }
    
    public function onMessageFailed(WorkerMessageFailedEvent $event)
    {
    	$message = get_class($event->getEnvelope()->getMessage());
    	$trace = $event->getThrowable()->getTraceAsString();
    	$email = (new Email())
		    ->from('')
		    ->to('')
		    ->text(
		    	$message.' - '.$trace
		    );
    	$this->mailer->send($email);
    	  dd($event->getEnvelope());
    }
}
