<?php

namespace App\Service;

use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Security\Core\Security;

class AppService
{
	private $parameterBag;
	private $logger;
	private $security;
	
	public function __construct(ParameterBagInterface $parameterBag, LoggerInterface $logger, Security $security)
	{
		$this->parameterBag = $parameterBag;
		$this->logger = $logger;
		$this->security = $security;
	}
	
	public function checkIfUploadsDirExist(): void
	{
		$filesystem = new Filesystem();
		if (!$filesystem->exists($this->parameterBag->get('app.upload_dir'))) {
			$filesystem->mkdir($this->parameterBag->get('app.upload_dir'));
		}
	}
}