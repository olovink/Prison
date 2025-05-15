<?php

declare(strict_types=1);

namespace prison\mine\task;

use pocketmine\scheduler\Task;
use pocketmine\Server;
use prison\mine\MineManager;
use prison\Prison;
use prison\utils\Timer;

class MineUpdateTask extends Task {


    public function __construct(
        private MineManager $mineManager
    ) {}

    public function onRun(int $currentTick): void {
        $mineStorage = $this->mineManager->getMineStorage();

        if (count($mineStorage) == 0) {
            return;
        }

        foreach ($mineStorage as $mine) {
            $mineTimer = $mine->getTimer();

            if ($mineTimer->isComplete()) {
                $this->mineManager->getMineFillManager()->fill($mine);
            }

            //Server::getInstance()->getLogger()->info(sprintf("'%s' Time to reset => (%s)", $mine->getName(), $mine->getTimer()->getTime()));
        }
    }
}