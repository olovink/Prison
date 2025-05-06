<?php

declare(strict_types=1);

namespace prison\mine\entry;

class MineEntry {

    public function __construct(
        private MinePosition $minePosition,
        /** @var MineBlockEntry[] */
        private array $blockPool
    ) {}

    public function getBlockPool(): array{
        return $this->blockPool;
    }

    public function getMinePosition(): MinePosition{
        return $this->minePosition;
    }
}