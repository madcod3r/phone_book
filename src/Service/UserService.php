<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;

final class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager){
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    public function getAllUsers(): ?array
    {
        return $this->userRepository->findAll();
    }

    public function searchUser(string $userName): ?array
    {
        return $this->userRepository->findByName($userName);
    }

    public function getUser(int $userId): ?User
    {
        return $this->userRepository->find($userId);
    }

    public function addUser(string $phone, string $name): User
    {
        $user = new User();
        $user->setPhone($phone);
        $user->setName($name);

        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        } catch (ORMException $exception) {
            echo $exception->getMessage();
        }

        return $user;
    }

    public function updateUser(int $userId, string $phone, string $name): ?User
    {
        $user = $this->getUser($userId);
        if (!$user) {
            return null;
        }
        $user->setPhone($phone);
        $user->setName($name);

        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        } catch (ORMException $exception) {
            echo $exception->getMessage();
        }

        return $user;
    }

    public function deleteUser(int $userId): void
    {
        $user = $this->userRepository->find($userId);
        if ($user) {
            try {
                $this->entityManager->remove($user);
                $this->entityManager->flush();
            } catch (ORMException $exception) {
                echo $exception->getMessage();
            }
        }
    }

}