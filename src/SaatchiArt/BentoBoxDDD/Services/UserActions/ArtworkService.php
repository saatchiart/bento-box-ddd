<?php

declare(strict_types=1);

namespace SaatchiArt\BentoBoxDDD\Services\UserActions;

use SaatchiArt\BentoBoxDDD\Services\UserActions\SecondaryAdapters\Repositories\ArtworkRepositoryInterface as ArtworkRepository;

final class ArtworkService
{
    /** @var ArtworkRepository */
    private $artworkRepository;

    public function __construct(
        ArtworkRepository $artworkRepository
    ) {
        $this->artworkRepository = $artworkRepository;
    }

    public function makeNotForSaleByUserId(int $userId): void
    {
        $artworks = $this->artworkRepository->getByUserId($userId);

        foreach ($artworks as $artwork) {
            $artwork->makeNotForSale();
            $this->artworkRepository->storeArtwork($artwork);
        }
    }
}
