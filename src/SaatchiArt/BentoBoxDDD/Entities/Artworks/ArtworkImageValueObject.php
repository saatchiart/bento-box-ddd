<?php

declare(strict_types=1);

namespace SaatchiArt\BentoBoxDDD\Entities\Artworks;

final class ArtworkImageValueObject
{
    /** @var string */
    private $relativePath;

    public function __construct(string $relativePath)
    {
        $this->relativePath = $relativePath;
    }

    public function getRelativePath(): string
    {
        return $this->relativePath;
    }

    public function getAbsolutePath(): string
    {
        return \SITE_BASE_URL . $this->relativePath;
    }
}
