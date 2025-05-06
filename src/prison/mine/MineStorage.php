<?php

declare(strict_types=1);

namespace prison\mine;

class MineStorage {

    /** @var array<int, Mine> */
    private array $mineStorage = [];
    private int $mineId = 0;

    /** @return array<int, Mine> */
    public function getStorage(): array{
        return $this->mineStorage;
    }

    public function addMine(Mine $mine): void{
        $this->mineId++;
        $this->mineStorage[$this->mineId] = $mine;
    }

    public function removeMine(Mine $mine): void{
        unset($this->mineStorage[$this->mineId]);
    }
}
