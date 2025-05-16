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
            "dirty" => [
                "world-name" => "world",
                "coloredName" => "§7Пыльная шахта§r",
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
                        "3:0" => [
                            "chance" => 100
                        ],
                        "12:0" => [
                            "chance" => 70
                        ],
                        "13:0" => [
                            "chance" => 50
                        ]
                    ],
                ],
                "timeReset" => 60 * 5 * 15
            ],
            "jungle" => [
                "world-name" => "world",
                "coloredName" => "§aРастительная шахта",
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
                        "35:13" => [
                            "chance" => 100
                        ],
                        "17:3" => [
                            "chance" => 50
                        ],
                        "103:0" => [
                            "chance" => 30
                        ]
                    ],
                ],
                "timeReset" => 60 * 5 * 15
            ]
        ];
    }

}