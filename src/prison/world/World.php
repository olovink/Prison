<?php

declare(strict_types=1);

namespace prison\world;

use pocketmine\level\Level;
use prison\mine\Mine;

class World {

    public function __construct(
        private Level $level,
        private Mine $mine
    ) {}

    public function onRun(): void{

    }

    public function getLevel(): Level{
        return $this->level;
    }

    public function getMine(): Mine{
        return $this->mine;
    }
}