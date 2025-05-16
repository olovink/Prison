<?php

declare(strict_types=1);

namespace prison\utils;

use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Vector3;

class MathUtils {

    public static function isInside(Vector3 $vector3, AxisAlignedBB $axisAlignedBB): bool{
        if ($vector3->x >= $axisAlignedBB->minX && $vector3->x <= $axisAlignedBB->maxX &&
            $vector3->y >= $axisAlignedBB->minY && $vector3->y <= $axisAlignedBB->maxY &&
            $vector3->z >= $axisAlignedBB->minZ && $vector3->z <= $axisAlignedBB->maxZ) {
            return true;
        }
        return false;
    }

}