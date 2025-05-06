<?php

declare(strict_types=1);

namespace prison\mine;

use prison\mine\entry\BlockEntry;
use prison\mine\entry\MinePosition;

class Mine {

    public function __construct(
        private MinePosition $minePosition,
        /** @var BlockEntry[] */
        private array $blockPool
    ) {}

    public function getBlockPool(): array{
        return $this->blockPool;
    }

    public function getMinePosition(): MinePosition{
        return $this->minePosition;
    }
}