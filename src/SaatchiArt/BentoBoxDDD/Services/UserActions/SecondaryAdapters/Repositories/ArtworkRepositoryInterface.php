<?php

declare(strict_types=1);

namespace SaatchiArt\BentoBoxDDD\Services\UserActions\SecondaryAdapters\Repositories;

use SaatchiArt\BentoBoxDDD\Entities\Artworks\ArtworkEntity;

interface ArtworkRepositoryInterface
{
    /** @return ArtworkEntity[] */
    public function getByUserId(int $userId): array;

    public function storeArtwork(ArtworkEntity $artwork): void;
}
