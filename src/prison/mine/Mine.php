<?php

declare(strict_types=1);

namespace prison\mine;

use pocketmine\level\Level;
use pocketmine\Server;
use prison\mine\entry\MineEntry;
use prison\mine\exception\MineException;
use prison\utils\Timer;

class Mine {

    private const MINE_RESET_TIME_DEFAULT = 15 * 60;

    public function __construct(
        private string $name = "default",
        private string $levelName = "world",
        private ?MineEntry $mineEntry = null,
        private ?Timer $timer = null
    ) {
        if ($this->timer == null) $this->timer = new Timer(self::MINE_RESET_TIME_DEFAULT);
    }

    public function getTimer(): Timer{
        return $this->timer;
    }

    public function getMineEntry(): MineEntry{
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

    public function getLevel(): ?Level{
        if (($level = Server::getInstance()->getLevelByName($this->levelName)) == null) {
            throw new MineException("Level '$this->levelName' not found");
        }

        if (!Server::getInstance()->isLevelLoaded($this->levelName)) {
            Server::getInstance()->loadLevel($this->levelName);
        }

        return $level;
    }

}