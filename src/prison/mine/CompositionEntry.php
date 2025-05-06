<?php

declare(strict_types=1);

namespace prison\mine;

use pocketmine\block\Block;

class CompositionEntry {

    public function __construct(
        private Block $block,
        private float $chance
    ) {}

    public function getBlock(): Block{
        return $this->block;
    }

    public function getChance(): float{
        return $this->chance;
    }

}