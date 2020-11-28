<?php

namespace App\MessageHandler;

use App\Message\AppMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class AppMessageHandler implements MessageHandlerInterface
{
	private $em;
	
	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;
	}
	
	public function __invoke(AppMessage $message)
    {
        // do something with your message
    }
}
