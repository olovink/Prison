<?php

declare(strict_types=1);

namespace prison\mine;

use pocketmine\block\Block;
use pocketmine\math\Vector3;
use pocketmine\Server;
use prison\mine\entry\BlockEntry;
use prison\Prison;

class MineFillManager {

    public function __construct(
        private MineManager $mineManager
    ) {}

    public function fillAll(): void{
        foreach ($this->mineManager->getMineStorage() as $mine) {
            $this->fill($mine);
        }
    }

    public function fill(Mine $mine): void{
        $mineName = $mine->getName();
        $mineColoredName = $mine->getColoredName();

        if ($mine->getMineEntry() == null) {
            Prison::getInstance()->getLogger()->error(sprintf("Prison '%s' not filled, MineEntry is null", $mineName));
            $this->mineManager->unregisterMine($mine);
            return;
        }

        $minePosition = $mine->getMineEntry()->getMinePosition();

        $minX = $minePosition->getMinX();
        $minZ = $minePosition->getMinZ();
        $minY = $minePosition->getMinY();

        $maxX = $minePosition->getMaxX();
        $maxY = $minePosition->getMaxY();
        $maxZ = $minePosition->getMaxZ();

        $level = $mine->getLevel();

        for ($x = $minX; $x <= $maxX; ++$x) {
            for ($y = $minY; $y <= $maxY; ++$y) {
                for ($z = $minZ; $z <= $maxZ; ++$z) {
                    if ($y == $maxY) {
                        $level->setBlock(new Vector3($x, $y, $z), $mine->getMineEntry()->getFirstLayer()->asBlock());
                    } else {
                        $blockEntry = $this->pickBlock($mine);
                        $level->setBlock(new Vector3($x, $y, $z), $blockEntry->asBlock());
                    }
                }
            }
        }

        foreach ($level->getPlayers() as $player) {
            if ($this->mineManager->insideMine($player)) {
                $player->teleport(new Vector3(
                        $player->getFloorX(),
                            $level->getHighestBlockAt(
                                $player->getFloorX(),
                                $player->getFloorZ()
                            ),
                        $player->getFloorZ()
                    )
                );
            }
        }

        $mine->broadcastMessage("'$mineColoredName' обновлена!");
    }

    public function pickBlock(Mine $mine): ?BlockEntry {
        $mineBlockStorage = $mine->getMineEntry()->getBlockPool();

        $totalChance = 0;
        foreach ($mineBlockStorage as $block) {
            $totalChance += $block->getChance();
        }

        $random = rand(1, $totalChance);
        $currentChance = 0;

        foreach ($mineBlockStorage as $block) {
            $currentChance += $block->getChance();
            if ($random <= $currentChance) {
                return $block->getBlockEntry();
            }
        }

        return null;
    }
}