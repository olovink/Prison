<?php

declare(strict_types=1);

namespace prison\mine\entry;

class MineEntry {

    public function __construct(
        private MinePosition $minePosition,
        /** @var MineBlockEntry[] */
        private array $blockPool,
        private BlockEntry $firstLayer
    ) {}

    public function getBlockPool(): array{
        return $this->blockPool;
    }

    public function getFirstLayer(): BlockEntry{
        return $this->firstLayer;
    }

    public function addBlockToPool(MineBlockEntry $blockEntry): void{
        $this->blockPool[] = $blockEntry;
    }

    public function getMinePosition(): MinePosition{
        return $this->minePosition;
    }
}