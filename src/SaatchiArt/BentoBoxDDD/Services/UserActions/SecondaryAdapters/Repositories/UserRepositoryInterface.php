<?php

declare(strict_types=1);

namespace SaatchiArt\BentoBoxDDD\Services\UserActions\SecondaryAdapters\Repositories;

use SaatchiArt\BentoBoxDDD\Entities\UserEntity;

interface UserRepositoryInterface
{
    /** @throws \SaatchiArt\BentoBoxDDD\Exceptions\UserNotFoundException */
    public function findByUserId(int $userId): UserEntity;

    public function storeUser(UserEntity $user): void;
}
