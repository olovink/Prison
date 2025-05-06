<?php

declare(strict_types=1);

namespace prison\mine;

use pocketmine\level\Level;
use pocketmine\Server;
use prison\mine\entry\MineEntry;

class Mine {

    public function __construct(
        private string $name = "default",
        private string $levelName = "world",
        private ?MineEntry $mineEntry = null
    ) {}

    public function getMineEntry(): MineEntry{
        return $this->mineEntry;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getLevelName(): string{
        return $this->levelName;
    }

    public function getLevel(): ?Level{
        return Server::getInstance()->getLevelByName($this->levelName);
    }

}