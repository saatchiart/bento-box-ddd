<?php

declare(strict_types=1);

namespace SaatchiArt\BentoBoxDDD\Events;

final class UserUpdatedEvent
{
    /** @var int */
    private $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}
