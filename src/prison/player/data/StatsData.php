<?php

declare(strict_types=1);

namespace prison\player\data;

class StatsData {

    public function __construct(
        private float $money,
        private int $exp,
        private int $level,
        private int $caveLevel,
        private int $blockBreakCount,
        private int $playTime
    ) {}

    public function getMoney(): float{
        return $this->money;
    }

    public function getExp(): int{
        return $this->exp;
    }

    public function addExp(int $value): void{
        $this->exp = $value;
    }

    public function getCaveLevel(): int{
        return $this->caveLevel;
    }

    public function addCaveLevel(): void{
        $this->caveLevel++;
    }

    public function getLevel(): int{
        return $this->level;
    }

    public function addLevel(): void{
        $this->level++;
    }

    public function getBlockBreakCount(): int{
        return $this->blockBreakCount;
    }

    public function addBlockBreakCount(): void{
        $this->blockBreakCount++;
    }

    public function getPlayedTime(): int{
        return $this->playTime;
    }

    public function addPlayTime(): void{
        $this->playTime++;
    }

}