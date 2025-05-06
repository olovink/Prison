<?php

declare(strict_types=1);

namespace prison\mine\entry;

class MineBlockEntry {

    public function __construct(
        private BlockEntry $blockEntry,
        private float $chance
    ) {}

    public function getBlockEntry(): BlockEntry{
        return $this->blockEntry;
    }

    public function getChance(): float{
        return $this->chance;
    }

}