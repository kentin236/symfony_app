<?php

namespace App\Controller;

use App\Entity\FileEntity;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class AppController extends AbstractController
{
	private $em;
	private $logger;
	
	public function __construct(EntityManagerInterface $em, LoggerInterface $logger)
	{
		$this->em = $em;
		$this->logger = $logger;
	}

    /**
     * @Route(path="/index", name="index", methods={"GET", "POST"}, schemes={"http","https"})
     * @param string $world
     */
	public function index($world = "World"): void
	{
		$this->logger->info("Index Route");
		dump("Hello $world");
		die;
	}
	
	/**
	 * @Route(path="/app", name="app", methods={"GET"})
	 * @return Response
	 */
    public function app(): Response
    {
	    // $this->addFlash('success', "Hello World");
	    return $this->render('app/index.html.twig', [
	        'controller_name' => 'AppController',
		    'files_entity' => $this->em->getRepository(FileEntity::class)->findAll() ?: []
	    ]);
    }
	
	/**
	 * @Route(path="/app/phpinfo", name="app_phpinfo", methods={"GET"})
	 */
    public function phpInfo(): void
    {
    	dd(phpinfo());
    }
	
	/**
	 * @Route(path="/app/submit-file", name="app_submit_file", methods={"POST"})
	 * @param Request $request
	 * @param SluggerInterface $slugger
	 * @return RedirectResponse
	 */
    public function submitFile(Request $request, SluggerInterface $slugger): RedirectResponse
    {
  	    $file = $request->files->get('file', null);
  	    if ($file instanceof UploadedFile) {
  		    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
  		    $safeFilename = $slugger->slug($originalName);
  		    $newFilename = $safeFilename.'.'.uniqid('', true).'.'.$file->guessExtension();
		    try {
		  	    $filesystem = new Filesystem();
		  	    if (!$filesystem->exists($this->getParameter('app.upload_dir'))) {
		  		    $filesystem->mkdir($this->getParameter('app.upload_dir'));
			    }
			    $file->move(
			  	$this->getParameter('app.upload_dir'),
				    $newFilename
			    );
			    $newFile = new FileEntity();
			    $newFile->setFilename($newFilename);
			    $this->em->persist($newFile);
			    $this->em->flush();
			    $this->addFlash('success', "Success");
		    } catch (FileException $exception) {
		  	    $this->addFlash('danger', "Error");
		    }
	    }
  	    return $this->redirectToRoute('app');
    }
	
	/**
	 * @Route(path="/app/delete-file/{fileId}", name="app_delete_file", methods={"GET"})
	 * @param $fileId
	 * @param Filesystem $filesystem
	 * @return RedirectResponse
	 */
    public function deleteFile($fileId, Filesystem $filesystem): RedirectResponse
    {
  	    $file = $this->em->getRepository(FileEntity::class)->find($fileId);
  	    if ($file) {
		    try {
			    $filesystem->remove($this->getParameter('app.upload_dir').'/'.$file->getFilename());
			    $this->em->remove($file);
			    $this->em->flush();
			    $this->addFlash('success', "Success");
		    } catch (FileException $exception) {
		  	    $this->addFlash('danger', "Error");
		    }
  		    $this->addFlash('danger', "Error");
	    }
  	    return $this->redirectToRoute('app');
    }
}
