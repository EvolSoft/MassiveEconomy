<?php

/*
 * MassiveEconomy (v1.0 R3) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: http://www.evolsoft.tk
 * Date: 27/12/2014 04:06 PM (UTC)
 * Copyright & License: (C) 2014 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/MassiveEconomy/blob/master/LICENSE)
 */

namespace MassiveEconomy;

use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\permission\Permission;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\TextFormat;

use MassiveEconomy\MassiveEconomyAPI;

class RegisterEvent implements Listener{
    
	public function __construct(MassiveEconomyAPI $plugin){
		$this->plugin = $plugin;
	}
	
    //Automatic player registration
    public function onJoin(PlayerJoinEvent $event){
    	$player = $event->getPlayer();
    	if(!MassiveEconomyAPI::getInstance()->isPlayerRegistered($player->getName())){
    		MassiveEconomyAPI::getInstance()->registerPlayer($player);
    		$this->plugin->getLogger()->notice($this->plugin->translateColors("&", "&6User &2" . $player->getName() . "&6 now registered."));
    		if($player->hasPermission("massiveeconomy.receivedefault")){
    			MassiveEconomyAPI::getInstance()->payPlayer($player->getName(), MassiveEconomyAPI::getInstance()->getDefaultMoney());
    		}
    	}
    }
}
?>
