<?php

declare(strict_types=1);

namespace SaatchiArt\BentoBoxDDD\Entities;

final class ArtworkEntity
{
    /** @var int */
    private $id;

    /** @var bool */
    private $isForSale;

    public function __construct(int $id, bool $isForSale)
    {
        $this->id = $id;
        $this->isForSale = $isForSale;
    }

    public function makeNotForSale(): void
    {
        $this->isForSale = false;
    }

    public function isForSale(): bool
    {
        return $this->isForSale;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
