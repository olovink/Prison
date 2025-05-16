<?php

declare(strict_types=1);

namespace prison\handler;

use pocketmine\event\inventory\CraftItemEvent;
use pocketmine\event\Listener;

class PlayerHandler implements Listener {

    public function onCraft(CraftItemEvent $event): void{
        $event->setCancelled();
    }

}