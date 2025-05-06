<?php

declare(strict_types=1);

namespace prison;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class Prison extends PluginBase {

    private static Prison $instance;

    public function onLoad(): void{
        self::$instance = $this;

        $this->getLogger()->info(TextFormat::YELLOW . "Loading Prison...");
    }

    public function onEnable(): void{
    }

    public static function getInstance(): self{
        return self::$instance;
    }

}