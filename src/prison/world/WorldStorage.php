<?php

declare(strict_types=1);

namespace prison\world;

use pocketmine\Server;
use prison\mine\Mine;

class WorldStorage {

    /** @var World[] */
    private array $worldStorage;

    /** @return World[] */
    public function getStorage(): array{
        return $this->worldStorage;
    }

    /**
     * @param Mine $mine
     * @return void
     * @throws WorldException
     */
    public function addWorld(Mine $mine): void{
        $worldName = $mine->getWorldName();

        if (!Server::getInstance()->isLevelLoaded($worldName)) {
            if (!Server::getInstance()->loadLevel($worldName)) {
                throw new WorldException("World $worldName not loaded, invalid name.");
            }
        } else {
            Server::getInstance()->getLogger()->info("World '$worldName' loaded.");
        }

        $level = Server::getInstance()->getLevelByName($worldName);

        if ($level == null) {
            throw new WorldException("World $worldName not found.");
        }

        $this->worldStorage[] = new World($level, $mine);
    }
}