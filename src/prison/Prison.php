<?php

declare(strict_types=1);

namespace prison;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use prison\configuration\Configuration;
use prison\handler\BlockHandler;
use prison\handler\PlayerHandler;
use prison\mine\MineManager;
use prison\command\CommandManager;
use prison\player\PlayerCreation;

class Prison extends PluginBase {

    private static Prison $instance;
    private MineManager $mineManager;
    private Configuration $configuration;

    public function onLoad(): void{
        self::$instance = $this;
        $this->getLogger()->info(TextFormat::YELLOW . "Loading Prison...");

        $this->configuration = new Configuration($this);
        $this->mineManager = new MineManager($this);

        CommandManager::init();
    }

    public function onEnable(): void{
        $this->mineManager->init();

        $this->getServer()->getPluginManager()->registerEvents(new BlockHandler(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PlayerCreation(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new PlayerHandler(), $this);
    }

    public static function getInstance(): self{
        return self::$instance;
    }

    public function getMineManager(): MineManager{
        return $this->mineManager;
    }

    public function getConfiguration(): Configuration{
        return $this->configuration;
    }

}