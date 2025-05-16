<?php

declare(strict_types=1);

namespace prison\mine\entry;

class MineEntry {

    public function __construct(
        private readonly MinePosition $minePosition,
        /** @var MineBlockEntry[] */
        private readonly array        $blockPool,
        private readonly BlockEntry   $firstLayer
    ) {}

    public function getBlockPool(): array{
        return $this->blockPool;
    }

    public function getFirstLayer(): BlockEntry{
        return $this->firstLayer;
    }

    public function getMinePosition(): MinePosition{
        return $this->minePosition;
    }
}