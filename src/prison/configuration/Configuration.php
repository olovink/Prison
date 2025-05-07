<?php

declare(strict_types=1);

namespace prison\configuration;

use pocketmine\utils\Config;
use prison\Prison;

class Configuration {

    private array $settings = [];

    public function __construct(
        private Prison $prison
    ) {
        $config = new Config(
            $this->prison->getDataFolder() . "config.yml",
            Config::YAML,
            $this->getDefaultSettings()
        );

        $this->settings = $config->getAll();
    }

    public function getDefaultSettings(): array{
        return [
            "server-motd" => "§d§lPrison",
            "server-name" => "Alacrity",
            "mode" => "Prison",
            "mine-update-interval" => 60 * 5,
        ];
    }

    public function getSettings(): array{
        return $this->settings;
    }

}