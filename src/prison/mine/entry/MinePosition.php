<?php

declare(strict_types=1);

namespace prison\mine\entry;

use pocketmine\math\AxisAlignedBB;

class MinePosition {

    public function __construct(
        private int $minX,
        private int $minY,
        private int $minZ,

        private int $maxX,
        private int $maxY,
        private int $maxZ
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

    public function getAsAxisAlignedBB(): AxisAlignedBB{
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