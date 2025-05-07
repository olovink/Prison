<?php

declare(strict_types=1);

namespace prison\utils;

class Timer {

    private int $time;

    public function __construct(
        private int $startTime,
        private int $step = 1 // every 1 tick
    ) {
        $this->time = $this->startTime;
    }

    public function isComplete(bool $onTick): bool{
        if ($onTick) {
            // Типа штоби контроллировать кагда нада атнимать тики
            $this->onTick();
        }

        if ($this->time == 0) {
            $this->time = $this->startTime;
            return true;
        }
        return false;
    }

    public function onTick(): void{
        if ($this->time > 0) {
            $this->time -= $this->step;
        }
    }
}