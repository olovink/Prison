<?php

declare(strict_types=1);

namespace prison\mine\entry;

use pocketmine\block\Block;

class BlockEntry {

    public function __construct(
        private int $id,
        private int $meta
    ) {}

    public function getId(): int{
        return $this->id;
    }

    public function getMeta(): int{
        return $this->meta;
    }

    public function asBlock(): Block{
        return Block::get($this->id, $this->meta);
    }
}