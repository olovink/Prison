<?php

declare(strict_types=1);

namespace prison\player;

use prison\Prison;
use prison\utils\TipBoardBuilder;

trait TipBoardTrait {

    public function tickTipBoard(): void{
        $onlinePlayers = $this->getServer()->getOnlinePlayers();

        $this->sendTip(
            (new TipBoardBuilder())
                ->addLine("    §d§lPrison")
                ->addLine("Online: §7" . count($onlinePlayers))
                ->addLine('')
                ->addLine('Your name: §e' . $this->getName())
                ->addLine('Level: §e§l' . $this->getStatsData()->getLevel())
                ->addLine('')
                ->addLine('Blocks: §b' . $this->getStatsData()->getBlockBreakCount())
                ->addLine('Exp: §a' . $this->getStatsData()->getExp())
                ->createBoard()
        );
    }

}