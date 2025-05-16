<?php

declare(strict_types=1);

namespace prison\player;

use pocketmine\Player;
use prison\player\data\StatsData;

class MinePlayer extends Player {
    use TipBoardTrait;

    private StatsData $statsData;

    public function getStatsData(): StatsData{
        return $this->statsData;
    }

    public function initialize(): void{
        $this->statsData = new StatsData(0.0, 0, 1, 0, 0, 0);
    }

    public function onUpdate($currentTick): bool {
        if (!($currentTick % 20)) {
            if ($this->isBedrock()) {
                //
            } else {
                $this->tickTipBoard();
            }
        }

        return parent::onUpdate($currentTick);
    }
}