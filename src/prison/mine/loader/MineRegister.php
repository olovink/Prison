<?php

declare(strict_types=1);

namespace prison\mine\loader;

use prison\mine\entry\BlockEntry;
use prison\mine\entry\MineBlockEntry;
use prison\mine\entry\MineEntry;
use prison\mine\entry\MinePosition;
use prison\mine\exception\MineException;
use prison\mine\exception\MineLoaderException;
use prison\mine\Mine;
use prison\Prison;
use prison\utils\Timer;

class MineRegister {

    public static function register(Mine &$mine, string $mineName, array $mineData): void{
        $worldName = self::getValue($mineData, 'world-name');
        $coloredName = self::getValue($mineData, 'coloredName');
        $mineLevel = self::getValue($mineData, "mine-level");
        $positionData = self::getValue($mineData, 'position');
        $blocks = self::getValue($mineData, 'blocks');
        $timeReset = self::getValue($mineData, 'timeReset');
        $firstLayer = self::getValue($mineData, 'firstLayer');

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
                Prison::getInstance()->getLogger()->info("'$mineName' Block ($id:$meta) $blockChance% chance");
            }
        }

        Prison::getInstance()->getLogger()->info(sprintf("'%s' time reset: %s seconds", $mineName, $timeReset));

        [$id, $meta] = explode(':', $firstLayer);

        $mine = new Mine(
            $mineName,
            $worldName,
            $coloredName,
            $mineLevel,
            new MineEntry($minePosition, $mineEntries, new BlockEntry((int) $id, (int) $meta)),
            new Timer($timeReset)
        );
    }

    public static function getValue(array $data, string $value): mixed{
        if (!isset($data[$value])) {
            throw new MineLoaderException("Not found '$value' value");
        }

        return $data[$value];
    }
}