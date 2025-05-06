<?php

declare(strict_types=1);

namespace prison\mine;

use prison\mine\loader\MineConfigLoader;
use prison\mine\loader\MineRegister;
use prison\Prison;

class MineManager {

    /** @var array<Mine> */
    private array $mineStorage = [];

    private int $mineId = 0;

    private MineConfigLoader $mineConfigLoader;

    public function __construct(
        private Prison $prison
    ) {
        $this->mineConfigLoader = new MineConfigLoader($this->prison);
    }

    public function init(): void{
        foreach ($this->mineConfigLoader->getData() as $mineName => $mineData) {
            $mine = new Mine();

            MineRegister::registerMine($mine, $mineName, $mineData);
            $this->addMine($mine);
        }
    }

    public function addMine(Mine $mine): void{
        $this->mineId++;
        $this->mineStorage[$this->mineId] = $mine;

        $mineName = $mine->getName();

        $this->prison->getLogger()->info("Registered mine '$mineName' with id '$this->mineId'");
    }

    public function getMineConfig(): MineConfigLoader{
        return $this->mineConfigLoader;
    }

    /** @return Mine[] */
    public function getMineStorage(): array{
        return $this->mineStorage;
    }
}