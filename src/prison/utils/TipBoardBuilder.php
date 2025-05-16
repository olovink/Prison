<?php

declare(strict_types=1);

namespace prison\utils;


use pocketmine\utils\TextFormat;

class TipBoardBuilder {

    private array $strings = [];

    public function addLine(string $text): self{
        $this->strings[] = $text;
        return $this;
    }

    public function createBoard(): string {
        $padding = str_repeat(" ", 75);
        $formattedStrings = array_map(function($string) use ($padding) {
            return $padding . $string . TextFormat::RESET;
        }, $this->strings);

        return implode("\n", $formattedStrings) . str_repeat("\n", 7);
    }

}