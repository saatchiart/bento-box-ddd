<?php

declare(strict_types=1);

namespace SaatchiArt\BentoBoxDDD\Entities\Artworks;

use SaatchiArt\BentoBoxDDD\Entities\Artworks\ArtworkImageValueObject as ArtworkImage;

final class ArtworkEntity
{
    /** @var int */
    private $id;

    /** @var bool */
    private $isForSale;

    /** @var ArtworkImage */
    private $artworkImage;

    public function __construct(
        int $id,
        bool $isForSale,
        ArtworkImage $artworkImage
    ) {
        $this->id = $id;
        $this->isForSale = $isForSale;
        $this->artworkImage = $artworkImage;
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

    public function getArtworkImageRelativePath(): string
    {
        return $this->artworkImage->getAbsolutePath();
    }

    public function getArtworkImageAbsolutePath(): string
    {
        return $this->artworkImage->getAbsolutePath();
    }
}
