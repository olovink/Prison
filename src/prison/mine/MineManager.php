<?php

declare(strict_types=1);

namespace prison\mine;

use pocketmine\block\Block;
use pocketmine\block\BlockIds;
use prison\world\World;

class MineManager {

    private MineStorage $mineStorage;

    public function init(): void{
        $this->mineStorage = new MineStorage();

        $this->mineStorage->addMine(
            new Mine(
                "Default",
                "world",
                0,
                0,
                0,
                0,
                0,
                0,
                [new CompositionEntry(Block::get(BlockIds::STONE), 100)]
            )
        );
    }

    public static function fillMine(World $world): void{

    }

    public function getMineStorage(): MineStorage{
        return $this->mineStorage;
    }
}