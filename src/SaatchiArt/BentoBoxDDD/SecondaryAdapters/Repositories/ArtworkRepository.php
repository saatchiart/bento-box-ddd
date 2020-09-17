<?php

declare(strict_types=1);

namespace SaatchiArt\BentoBoxDDD\SecondaryAdapters\Repositories;

use Illuminate\Database\ConnectionInterface as Database;
use SaatchiArt\BentoBoxDDD\Entities\ArtworkEntity;
use SaatchiArt\BentoBoxDDD\Services\UserActions\SecondaryAdapters\Repositories\ArtworkRepositoryInterface;

final class ArtworkRepository implements ArtworkRepositoryInterface
{
    /** @var Database */
    private $database;

    public function __construct(
        Database $database
    ) {
        $this->database = $database;
    }

    /** @return ArtworkEntity[] */
    public function getByUserId(int $userId): array
    {
        return $this
            ->database
            ->table('artworks')
            ->where('user_id', '=', $userId)
            ->get()
            ->map(function (\stdClass $row): ArtworkEntity {
                return new ArtworkEntity($row->id, $row->isForSale);
            })
            ->toArray();

    }

    public function storeArtwork(ArtworkEntity $artwork): void
    {
        $this
            ->database
            ->table('artworks')
            ->updateOrInsert([
                'id' => $artwork->getId(),
                'is_for_sale' => $artwork->isForSale(),
            ]);
    }
}
