<?php

declare(strict_types=1);

namespace prison\mine;

class MineFillManager {

    public function __construct(
        private MineManager $mineManager
    ) {}

    public function fillAll(): void{
        foreach ($this->mineManager->getMineStorage() as $mine) {
            $this->fill($mine);
        }
    }

    public function fill(Mine $mine): void{
        $mineName = $mine->getName();
        $mine->broadcastMessage("Шахта '$mineName' обновлена!");
    }
}