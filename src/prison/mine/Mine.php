<?php

declare(strict_types=1);

namespace prison\mine;

class Mine {

    public function __construct(
        private string $mineName,
        private string $worldName,

        private int $maxX,
        private int $maxY,
        private int $maxZ,

        private int $minX,
        private int $minY,
        private int $minZ,
        /** @return CompositionEntry[] */
        private array $blockList
    ) {}

    public function getMineName(): string{
        return $this->mineName;
    }

    public function getWorldName(): string{
        return $this->worldName;
    }

    // ====================================

    public function getMaxX(): int{
        return $this->maxX;
    }

    public function getMaxY(): int{
        return $this->maxY;
    }

    public function getMaxZ(): int{
        return $this->maxZ;
    }

    // ====================================

    public function getMinX(): int{
        return $this->minX;
    }

    public function getMinY(): int{
        return $this->minY;
    }

    public function getMinZ(): int{
        return $this->minZ;
    }

    // ====================================

    /** @return CompositionEntry[] */
    public function getBlockList(): array{
        return $this->blockList;
    }
}