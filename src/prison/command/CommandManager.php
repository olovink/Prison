<?php

declare(strict_types = 1);

namespace prison\command;

use prison\command\defaults\PosCommand;
use pocketmine\Server;

class CommandManager {

	public static function init(): void{
		$commandList = [
			new PosCommand()
		];

		$commandMap = Server::getInstance()->getCommandMap();
		$commandMap->registerAll("", $commandList);
	}

}