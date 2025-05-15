<?php

declare(strict_types=1);

namespace prison\mine;

use prison\mine\loader\MineRegister;
use prison\Prison;

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

        if ($mine->getMineEntry() == null) {
            Prison::getInstance()->getLogger()->error(sprintf("Prison '%s' not filled, MineEntry is null", $mineName));
            $this->mineManager->unregisterMine($mine);
            return;
        }
        $mine->broadcastMessage("Шахта '$mineName' обновлена!");
    }
}