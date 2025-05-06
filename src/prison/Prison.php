<?php

declare(strict_types=1);

namespace prison;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use prison\mine\MineManager;
use prison\world\WorldManager;

class Prison extends PluginBase {

    private MineManager $mineManager;
    private WorldManager $worldManager;
    private static Prison $instance;

    public function onLoad(): void{
        self::$instance = $this;

        $this->getLogger()->info(TextFormat::YELLOW . "Loading Prison...");
        $this->mineManager = new MineManager();
        $this->worldManager = new WorldManager($this);
    }

    public function onEnable(): void{
        $this->mineManager->init();
        $this->worldManager->init();

        $this->getLogger()->info(TextFormat::GREEN . "Prison loaded! Loaded §a" . count($this->mineManager->getMineStorage()->getStorage()). "§r mines.");
    }

    public function getMineManager(): MineManager{
        return $this->mineManager;
    }

    public function getWorldManager(): WorldManager{
        return $this->worldManager;
    }

    public static function getInstance(): self{
        return self::$instance;
    }

}