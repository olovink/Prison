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

    public function onUpdate($tick): void {
        if (!($tick % 20)) {
            $this->tickTipBoard();
        }

        parent::onUpdate($tick);
    }
}