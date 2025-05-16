<?php

declare(strict_types=1);

namespace prison\player;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCreationEvent;
use pocketmine\event\player\PlayerJoinEvent;
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

    public function onJoin(PlayerJoinEvent $event): void{
        /** @var MinePlayer $player */
        $player = $event->getPlayer();

        $player->sendMessage(
            "§7Привет, §e" . $player->getName() . ".§r \n" .
            "§7Добро пожаловать на сервер: §bAlacrity §7— §b§lPRISON§r\n\n" .
            "§7Мы рады видеть тебя на нашем сервере. Здесь ты сможешь:§r\n" .
            "§b§l◦§r §eИсследовать новые шахты§r \n" .
            "§b§l◦§r §eЗарабатывать деньги и ресурсы§r \n" .
            "§b§l◦§r §eЗаводить новых друзей и создавать альянсы§r \n§a"
        );
    }

}