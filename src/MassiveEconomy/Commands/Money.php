<?php

/*
 * MassiveEconomy (v1.0 R3) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: http://www.evolsoft.tk
 * Date: 27/12/2014 04:08 PM (UTC)
 * Copyright & License: (C) 2014 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/MassiveEconomy/blob/master/LICENSE)
 */

namespace MassiveEconomy\Commands;

use pocketmine\plugin\PluginBase;
use pocketmine\permission\Permission;
use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;

use pocketmine\utils\TextFormat;

use MassiveEconomy\MassiveEconomyAPI;

class Money extends PluginBase implements CommandExecutor{

	public function __construct(MassiveEconomyAPI $plugin){
        $this->plugin = $plugin;
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
    	$fcmd = strtolower($cmd->getName());
    	switch($fcmd){
    		case "money":
    			if($sender->hasPermission("massiveeconomy.commands.money")){
    				//Player Sender
    				if($sender instanceof Player){
    					if(isset($args[0])){
    						if($sender->hasPermission("massiveeconomy.commands.money.others")){
    							if(MassiveEconomyAPI::getInstance()->isPlayerRegistered($args[0])){
    								$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&4" . strtolower($args[0]) . "&6's money:&2 " . MassiveEconomyAPI::getInstance()->getMoney($args[0]) . MassiveEconomyAPI::getInstance()->getMoneySymbol()));
    							}else{
    								$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&cPlayer not found."));
    								return true;
    							}
    						}else{
    							$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    							break;
    						}
    					}else{
    						if(MassiveEconomyAPI::getInstance()->isPlayerRegistered($sender->getName())){
    							$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&6Your money: &2" . MassiveEconomyAPI::getInstance()->getMoney($sender->getName()) . MassiveEconomyAPI::getInstance()->getMoneySymbol()));
    						}else{
    							$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&cPlayer not found."));
    							return true;
    						}
    					}
    				}
    				//Console Sender
    				else{
    					if(isset($args[0])){
    						if(MassiveEconomyAPI::getInstance()->isPlayerRegistered($args[0])){
    							$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&4" . strtolower($args[0]) . "&6's money:&2 " . MassiveEconomyAPI::getInstance()->getMoney($args[0]) . MassiveEconomyAPI::getInstance()->getMoneySymbol()));
    						}else{
    							$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&cPlayer not found."));
    							return true;
    						}
    					}else{
    						$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&cUsage /money <player>"));
    					}
    				}
    			}else{
    				$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    				break;
    			}
    			return true;
    			}
    	}
}
?>
