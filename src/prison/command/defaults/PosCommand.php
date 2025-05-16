<?php

declare(strict_types = 1);

namespace prison\command\defaults;

use pocketmine\command\Command;
use pocketmine\Player;
use pocketmine\command\CommandSender;

class PosCommand extends Command{

	public function __construct() {
		parent::__construct("pos");
		$this->setAliases(["position", "xyz"]);
	}

	public function execute(CommandSender $sender, $commandLabel, array $args): bool{
		if (!$sender instanceof Player) return false;

		$sender->sendMessage(sprintf("Ваши координаты: x:%s y:%s z:%s", $sender->getX(), $sender->getY(), $sender->getZ()));
		return true;
	}
}