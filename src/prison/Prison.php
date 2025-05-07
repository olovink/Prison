<?php

declare(strict_types=1);

namespace prison;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use prison\configuration\Configuration;
use prison\mine\MineManager;

class Prison extends PluginBase {

    private static Prison $instance;
    private MineManager $mineManager;
    private Configuration $configuration;

    public function onLoad(): void{
        self::$instance = $this;
        $this->getLogger()->info(TextFormat::YELLOW . "Loading Prison...");

        $this->configuration = new Configuration($this);
        $this->mineManager = new MineManager($this);
    }

    public function onEnable(): void{
        $this->mineManager->init();
    }

    public static function getInstance(): self{
        return self::$instance;
    }

    public function getConfiguration(): Configuration{
        return $this->configuration;
    }

}