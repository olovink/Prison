<?php

declare(strict_types=1);

namespace prison\mine\entry;

use pocketmine\math\AxisAlignedBB;

class MinePosition {

    public function __construct(
        private readonly int $minX,
        private readonly int $minY,
        private readonly int $minZ,

        private readonly int $maxX,
        private readonly int $maxY,
        private readonly int $maxZ
    ) {}

    // ===========================

    public function getMinX(): int{
        return $this->minX;
    }

    public function getMinY(): int{
        return $this->minY;
    }

    public function getMinZ(): int{
        return $this->minZ;
    }

    // ===========================

    public function getMaxX(): int{
        return $this->maxX;
    }

    public function getMaxY(): int{
        return $this->maxY;
    }

    public function getMaxZ(): int{
        return $this->maxZ;
    }

    // ===========================

    public function getAxisAlignedBB(): AxisAlignedBB{
        return new AxisAlignedBB(
            $this->minX,
            $this->minY,
            $this->minZ,

            $this->maxX,
            $this->maxY,
            $this->maxZ
        );
    }
}