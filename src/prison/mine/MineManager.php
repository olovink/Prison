<?php

declare(strict_types=1);

namespace prison\mine;

use pocketmine\Server;
use prison\mine\loader\MineConfigLoader;
use prison\mine\loader\MineRegister;
use prison\mine\task\MineUpdateTask;
use prison\Prison;

class MineManager {

    /** @var array<int, Mine> */
    private array $mineStorage = [];

    private int $mineId = 0;

    private MineConfigLoader $mineConfigLoader;
    private MineFillManager $mineFillManager;
    private MineUpdateTask $mineUpdateTask;

    public function __construct(
        private Prison $prison
    ) {
        $this->mineConfigLoader = new MineConfigLoader($this->prison);
        $this->mineFillManager = new MineFillManager($this);
        $this->mineUpdateTask = new MineUpdateTask($this);
    }

    public function init(): void{
        foreach ($this->mineConfigLoader->getData() as $mineName => $mineData) {
            $mine = new Mine();

            MineRegister::register($mine, $mineName, $mineData);
            $this->addMine($mine);
        }

        Server::getInstance()->getScheduler()->scheduleRepeatingTask($this->mineUpdateTask, 20);
    }

    public function addMine(Mine $mine): void{
        $this->mineId++;
        $this->mineStorage[$this->mineId] = $mine;

        $mineName = $mine->getName();

        $this->prison->getLogger()->info("Registered mine '$mineName' with id '$this->mineId'");
    }

    public function getMineById(int $mineId): ?Mine{
        foreach ($this->mineStorage as $id => $mine) {
            if ($mineId == $id) {
                return $mine;
            }
        }
        return null;
    }

    public function getMineByName(string $name): ?Mine{
        foreach ($this->mineStorage as $mine) {
            if (strtolower($mine->getName()) == strtolower($name)) {
                return $mine;
            }
        }
        return null;
    }

    public function getMineUpdateRunner(): MineUpdateTask{
        return $this->mineUpdateTask;
    }

    public function getMineFillManager(): MineFillManager{
        return $this->mineFillManager;
    }

    public function getMineConfig(): MineConfigLoader{
        return $this->mineConfigLoader;
    }

    /** @return Mine[] */
    public function getMineStorage(): array{
        return $this->mineStorage;
    }
}