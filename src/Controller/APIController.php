<?php

namespace App\Controller;

use App\Entity\User;
use OpenApi\Annotations as OA;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class APIController extends AbstractController
{
	private $em;
	
	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;
	}
	
	/**
	 * @Route(path="/api/index", name="api_index_get", methods={"GET"})
	 * @OA\Response(
	 *   response="200",
	 *   description="Route api index get"
	 * )
	 * @OA\Parameter(
	 *   name="test",
	 *   in="query",
	 *   description="query parameter named test",
	 *   @OA\Schema(type="string")
	 * )
	 * @OA\Parameter(
	 *   in="header",
	 *   name="X-AUTH-TOKEN",
	 *   required=true
	 * )
	 * @OA\Tag(name="vanilla")
	 * @IsGranted("ROLE_USER")
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function index(Request $request): JsonResponse
	{
		$user = $this->getUser() ? $this->getUser()->getUsername() : null;
		if ($user instanceof User) {
			$user = $user->getInfos();
		}
		
		$data = [
			'user' => $user,
			'query' => $request->query->get('test')
		];
		return $this->json($data, Response::HTTP_OK);
	}
	
	/**
	 * @Route(path="/api/index", name="api_index_post", methods={"POST"})
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function post(Request $request): JsonResponse
	{
		$json = json_decode($request->getContent(), true);
		return $this->json($json, Response::HTTP_CREATED);
	}
	
	/**
	 * @Route(path="/api/index", name="api_index_put", methods={"PUT"})
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function put(Request $request): JsonResponse
	{
		$json = json_decode($request->getContent(), true);
		return $this->json($json, Response::HTTP_CREATED);
	}
	
	/**
	 * @Route(path="/api/index", name="api_index_patch", methods={"PATCH"})
	 * @param Request $request
	 * @return JsonResponse
	 */
	public function patch(Request $request): JsonResponse
	{
		$json = json_decode($request->getContent(), true);
		return $this->json($json, Response::HTTP_CREATED);
	}
	
	/**
	 * @Route(path="/api/index/{id}", name="api_index_delete", methods={"DELETE"})
	 * @param $id
	 * @return JsonResponse
	 */
	public function delete(string $id): JsonResponse
	{
		return $this->json([
			'id' => $id
		], Response::HTTP_OK);
	}

    /**
     * @Route(path="/api/index/postfile", name="api_index_post_file", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
	public function postFile(Request $request)
	{
		$file = $request->files->get('file', null);
		return $this->json([], Response::HTTP_OK);
	}
}