<?php

declare(strict_types=1);

namespace prison\player;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCreationEvent;
use pocketmine\event\player\PlayerLoginEvent;

class PlayerCreation implements Listener {

    public function onLogin(PlayerLoginEvent $event): void{
        /** @var MinePlayer $player */
        $player = $event->getPlayer();

        $player->initialize();
    }

    public function onCreatePlayer(PlayerCreationEvent $event): void{
        $event->setPlayerClass(MinePlayer::class);
    }

}