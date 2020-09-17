<?php

declare(strict_types=1);

namespace SaatchiArt\BentoBoxDDD\Entities\Users;

final class UserEntity
{
    /** @var int */
    private $id;

    /** @var bool */
    private $isOnVacation;

    public function __construct(int $id, bool $isOnVacation)
    {
        $this->id = $id;
        $this->isOnVacation = $isOnVacation;
    }

    public function goOnVacation(): void
    {
        $this->isOnVacation = true;
    }

    public function isOnVacation(): bool
    {
        return $this->isOnVacation;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
