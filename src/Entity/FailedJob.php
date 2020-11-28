<?php

namespace App\Entity;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Stamp\RedeliveryStamp;
use Symfony\Component\Messenger\Stamp\TransportMessageIdStamp;

class FailedJob
{
	private $envelop;
	
	public function __construct(Envelope $envelop)
	{
		$this->envelop = $envelop;
	}
	
	public function getMessage(): object
	{
		return $this->envelop->getMessage();
	}
	
	public function getId(): string
	{
		/** @var TransportMessageIdStamp[] $stamps $stamps */
		$stamps = $this->envelop->all(TransportMessageIdStamp::class);
		return end($stamps)->getId();
	}
	
	public function getTitle(): string
	{
		return get_class($this->envelop->getMessage());
	}
	
	public function getTrace(): string
	{
		$stamps = $this->envelop->all(RedeliveryStamp::class);
		return $stamps[0]->getFlattenException()->getTraceAsString();
	}
}