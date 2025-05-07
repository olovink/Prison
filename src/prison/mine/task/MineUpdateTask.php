<?php

declare(strict_types=1);

namespace prison\mine\task;

use pocketmine\scheduler\Task;
use prison\mine\MineManager;
use prison\Prison;
use prison\utils\Timer;

class MineUpdateTask extends Task {

    private Timer $timer;

    public function __construct(
        private MineManager $mineManager
    ) {
        $this->timer = new Timer(Prison::getInstance()->getConfiguration()->getSettings()["mine-update-interval"]);
    }

    public function onRun(int $currentTick): void {
        if (count($this->mineManager->getMineStorage()) == 0) {
            return;
        }

        if ($this->getTimer()->isComplete(true)) {
            $this->mineManager->getMineFillManager()->fillAll();
        }
    }

    public function getTimer(): Timer{
        return $this->timer;
    }
}