<?php

namespace App\Service;

use Symfony\Component\Messenger\MessageBusInterface;

class AsyncMethodService
{
	private $messageBus;
	public function __construct(MessageBusInterface $messageBus)
	{
		$this->messageBus = $messageBus;
	}
	
	public function async(string $serviceName, string $methodName, array $params)
	{
	
	}
}