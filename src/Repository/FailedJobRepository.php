<?php

namespace App\Repository;

use App\Entity\FailedJob;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Receiver\ListableReceiverInterface;

class FailedJobRepository
{
	private $receiver;
	
	public function __construct(ListableReceiverInterface $receiver)
	{
		$this->receiver = $receiver;
	}
	
	public function find(string $id): FailedJob
	{
		return new FailedJob($this->receiver->find($id));
	}
	
	public function findAll(): array
	{
		//return [];
		return array_map(fn (Envelope $envelop) => new FailedJob($envelop), iterator_to_array($this->receiver->all()));
		//return $this->receiver->all();
	}
	
	public function reject(string $id)
	{
		$this->receiver->reject($this->receiver->find($id));
	}
}