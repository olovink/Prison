<?php

declare(strict_types=1);

namespace prison\mine\loader;

use prison\mine\entry\BlockEntry;
use prison\mine\entry\MineBlockEntry;
use prison\mine\entry\MineEntry;
use prison\mine\entry\MinePosition;
use prison\mine\exception\MineLoaderException;
use prison\mine\Mine;
use prison\Prison;

class MineRegister {

    public static function register(Mine &$mine, string $mineName, array $mineData): void{
        $worldName = self::getValue($mineData, 'world-name');
        $positionData = self::getValue($mineData, 'position');
        $blocks = self::getValue($mineData, 'blocks');

        $minePosition = new MinePosition(
            $positionData['minX'],
            $positionData['minY'],
            $positionData['minZ'],
            $positionData['maxX'],
            $positionData['maxY'],
            $positionData['maxZ']
        );

        $mineEntries = [];
        foreach ($blocks as $blockSet) {
            foreach ($blockSet as $blockIdMeta => $blockInfo) {
                [$id, $meta] = explode(':', $blockIdMeta);
                $blockChance = $blockInfo['chance'];
                $mineEntries[] = new MineBlockEntry(new BlockEntry((int)$id, (int)$meta), $blockChance);
                Prison::getInstance()->getLogger()->info("'$mineName' Block ($id:$meta) => $blockChance chance");
            }
        }

        $mine = new Mine($mineName, $worldName, new MineEntry($minePosition, $mineEntries));
    }

    public static function getValue(array $data, string $value): mixed{
        if (($result = $data[$value]) == null) {
            throw new MineLoaderException("Not found '$value' value");
        }

        return $result;
    }
}