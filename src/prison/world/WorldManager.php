<?php

declare(strict_types=1);

namespace prison\world;

use pocketmine\Server;
use prison\Prison;

class WorldManager {

    private WorldStorage $worldStorage;

    public function __construct(
        private Prison $prison
    ) {}

    public function init(): void{
        $this->worldStorage = new WorldStorage();

        $mineManager = $this->prison->getMineManager();
        $storage = $mineManager->getMineStorage()->getStorage();

        foreach ($storage as $item => $value) {
            $this->worldStorage->addWorld($value);
            Server::getInstance()->getLogger()->info("Mine (" . $item . "-" . $value->getWorldName() . ") added to WorldStorage");
        }
    }

    public function getWorldStorage(): WorldStorage{
        return $this->worldStorage;
    }
}