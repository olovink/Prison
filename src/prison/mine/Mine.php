<?php

declare(strict_types=1);

namespace prison\mine;

use pocketmine\level\Level;
use pocketmine\Server;
use prison\mine\entry\MineEntry;
use prison\utils\Timer;

class Mine {

    public function __construct(
        private readonly string     $name = "default",
        private readonly string     $levelName = "world",
        private readonly string     $coloredName = "prison_mine",
        private readonly int        $mineLevel = 0,
        private readonly ?MineEntry $mineEntry = null,
        private readonly ?Timer     $timer = null
    ) {}

    public function getMineLevel(): int{
        return $this->mineLevel;
    }

    public function getColoredName(): string{
        return $this->coloredName;
    }

    public function getTimer(): ?Timer{
        return $this->timer;
    }

    public function getMineEntry(): ?MineEntry{
        return $this->mineEntry;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getLevelName(): string{
        return $this->levelName;
    }

    public function broadcastMessage(string $message): void{
        foreach ($this->getLevel()->getPlayers() as $player) {
            $player->sendMessage($message);
        }
    }

    public function getLevel(): Level{
        return Server::getInstance()->getLevelByName($this->levelName);
    }

}