<?php

declare(strict_types=1);

namespace SaatchiArt\BentoBoxDDD\Services\UserActions;

use SaatchiArt\BentoBoxDDD\Services\UserActions\SecondaryAdapters\Repositories\UserRepositoryInterface as UserRepository;

final class UserService
{
    /** @var UserRepository */
    private $userRepository;

    /** @var ArtworkService */
    private $artworkService;

    public function __construct(
        UserRepository $userRepository,
        ArtworkService $artworkService
    ) {
        $this->userRepository = $userRepository;
        $this->artworkService = $artworkService;
    }

    public function goOnVacation(int $userId): void
    {
        $user = $this->userRepository->findByUserId($userId);
        $user->goOnVacation();
        $this->userRepository->storeUser($user);

        $this->artworkService->makeNotForSaleByUserId($userId);

    }
}
