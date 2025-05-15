<?php

declare(strict_types=1);

namespace prison\mine\loader;

use pocketmine\utils\Config;
use prison\mine\Mine;
use prison\Prison;

class MineConfigLoader {

    private array $data;

    public function __construct(
        private Prison $prison
    ) {
        $config = new Config(
            $this->prison->getDataFolder() . "mines.yml",
            Config::YAML,
            $this->getDefaultData()
        );

        $this->data = $config->getAll();
    }

    public function getData(): array{
        return $this->data;
    }

    public function getDefaultData(): array{
        return [
            "default" => [
                "world-name" => "world",
                "position" => [
                    "minX" => 0,
                    "minY" => 0,
                    "minZ" => 0,
                    "maxX" => 0,
                    "maxY" => 0,
                    "maxZ" => 0,
                ],
                "blocks" => [
                    [
                        "1:0" => [
                            "chance" => 0
                        ],
                        "0:0" => [
                            "chance" => 0
                        ],
                    ],
                ],
                "timeReset" => 60 * 15
            ],
            "legendary" => [
                "world-name" => "world",
                "position" => [
                    "minX" => 1,
                    "minY" => 1,
                    "minZ" => 1,
                    "maxX" => 1,
                    "maxY" => 1,
                    "maxZ" => 1,
                ],
                "blocks" => [
                    [
                        "0:0" => [
                            "chance" => 0
                        ],
                    ],
                ],
                "timeReset" => 60 * 15
            ]
        ];
    }

}