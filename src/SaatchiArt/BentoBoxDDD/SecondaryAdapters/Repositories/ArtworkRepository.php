<?php

declare(strict_types=1);

namespace SaatchiArt\BentoBoxDDD\SecondaryAdapters\Repositories;

use Illuminate\Database\ConnectionInterface as Database;
use SaatchiArt\BentoBoxDDD\Entities\Artworks\ArtworkEntity;
use SaatchiArt\BentoBoxDDD\Entities\Artworks\ArtworkImageValueObject;
use SaatchiArt\BentoBoxDDD\Events\ArtworkUpdatedEvent;
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
                $artworkImage = new ArtworkImageValueObject($row->relative_image_path);
                return new ArtworkEntity($row->id, $row->isForSale, $artworkImage);
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
                'relative_image_path' => $artwork->getArtworkImageRelativePath(),
            ]);

        \event(new ArtworkUpdatedEvent($artwork->getId()));
    }
}
