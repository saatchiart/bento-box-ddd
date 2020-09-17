<?php

declare(strict_types=1);

namespace SaatchiArt\BentoBoxDDD\SecondaryAdapters\Repositories;

use Illuminate\Database\ConnectionInterface as Database;
use SaatchiArt\BentoBoxDDD\Entities\Users\UserEntity;
use SaatchiArt\BentoBoxDDD\Events\UserUpdatedEvent;
use SaatchiArt\BentoBoxDDD\Exceptions\UserNotFoundException;
use SaatchiArt\BentoBoxDDD\Services\UserActions\SecondaryAdapters\Repositories\UserRepositoryInterface;

final class UserRepository implements UserRepositoryInterface
{
    /** @var Database */
    private $database;

    public function __construct(
        Database $database
    ) {
        $this->database = $database;
    }

    /** @throws UserNotFoundException */
    public function findByUserId(int $userId): UserEntity
    {
        $row = $this
            ->database
            ->table('users')
            ->where('id', '=', $userId)
            ->first();

        if ($row === null) {
            throw new UserNotFoundException("User {$userId} not found.");
        }

        return new UserEntity($userId, $row->isOnVacation);
    }

    public function storeUser(UserEntity $user): void
    {
        $this
            ->database
            ->table('users')
            ->updateOrInsert([
                'id' => $user->getId(),
                'is_on_vacation' => $user->isOnVacation(),
            ]);

        \event(new UserUpdatedEvent($user->getId()));
    }
}
