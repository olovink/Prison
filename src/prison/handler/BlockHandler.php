<?php

declare(strict_types=1);

namespace prison\handler;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use prison\Prison;

class BlockHandler implements Listener {

    public function onBreak(BlockBreakEvent $event): void{
        if (!Prison::getInstance()->getMineManager()->insideMine($event->getBlock())) {
            $event->setCancelled();
            return;
        }

        $remaining = $event->getPlayer()->getInventory()->addItem(...$event->getDrops());
        $event->setDrops([]);

        if (!empty($remaining)) {
            $event->getPlayer()->sendMessage("§cЯ так устал, больше не унести.");
        }
    }

    public function onPlace(BlockPlaceEvent $event): void{
        if (!Prison::getInstance()->getMineManager()->insideMine($event->getBlock())) {
            $event->setCancelled();
        }
    }

}