<?php

declare(strict_types=1);

namespace prison\mine;

use Generator;
use pocketmine\math\Vector3;
use prison\mine\entry\BlockEntry;
use prison\Prison;

class MineFillManager {

    public function __construct(
        private readonly MineManager $mineManager
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
        $level = $mine->getLevel();

        foreach ($this->generateCoordinates($minePosition) as [$x, $y, $z]) {
            if ($y == $minePosition->getMaxY()) {
                $level->setBlock(new Vector3($x, $y, $z), $mine->getMineEntry()->getFirstLayer()->asBlock(), true, false);
            } else {
                $blockEntry = $this->pickBlock($mine);
                $level->setBlock(new Vector3($x, $y, $z), $blockEntry->asBlock(), true, false);
            }
        }

        foreach ($level->getPlayers() as $player) {
            if ($this->mineManager->insideMine($player)) {
                $player->teleport(new Vector3(
                    $player->getFloorX(),
                    $level->getHighestBlockAt($player->getFloorX(), $player->getFloorZ()),
                    $player->getFloorZ()
                ));
            }
        }

        $mine->broadcastMessage("'$mineColoredName' обновлена!");
    }

    private function generateCoordinates($minePosition): Generator{
        $minX = $minePosition->getMinX();
        $minZ = $minePosition->getMinZ();
        $minY = $minePosition->getMinY();
        $maxX = $minePosition->getMaxX();
        $maxY = $minePosition->getMaxY();
        $maxZ = $minePosition->getMaxZ();

        for ($x = $minX; $x <= $maxX; ++$x) {
            for ($y = $minY; $y <= $maxY; ++$y) {
                for ($z = $minZ; $z <= $maxZ; ++$z) {
                    yield [$x, $y, $z];
                }
            }
        }
    }
    public function pickBlock(Mine $mine): ?BlockEntry{
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