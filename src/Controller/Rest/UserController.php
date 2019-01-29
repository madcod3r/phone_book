<?php

namespace App\Controller\Rest;

use App\Service\UserService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractFOSRestController
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Gets an Users
     * @Rest\Get("/users")
     * @return View
     */
    public function getUsers(): View
    {
        $users = $this->userService->getAllUsers();

        return View::create($users, Response::HTTP_OK);
    }

    /**
     * Search for an Users
     * @Rest\Get("/users/search/{userName}")
     * @param string $userName
     * @return View
     */
    public function searchUsers(string $userName): View
    {
        $user = $this->userService->searchUser($userName);

        return View::create($user, Response::HTTP_OK);
    }

    /**
     * Creates an User
     * @Rest\Post("/users")
     * @param Request $request
     * @return View
     */
    public function postUser(Request $request): View
    {
        $user = $this->userService->addUser($request->get('phone'), $request->get('name'));

        return View::create($user, Response::HTTP_CREATED);
    }

    /**
     * Updates an User
     * @Rest\Put("/users/{userId}")
     * @param Request $request
     * @param int $userId
     * @return View
     */
    public function putUser(Request $request, int $userId): View
    {
        $user = $this->userService->updateUser($userId, $request->get('phone'), $request->get('name'));

        return View::create($user, Response::HTTP_OK);
    }

    /**
     * Creates an User
     * @Rest\Delete("/users/{userId}")
     * @param int $userId
     * @return View
     */
    public function deleteUser(int $userId): View
    {
        $this->userService->deleteUser($userId);

        return View::create([], Response::HTTP_NO_CONTENT);
    }
}