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
use pocketmine\utils\TextFormat;

use MassiveEconomy\MassiveEconomyAPI;

class SetMoney extends PluginBase implements CommandExecutor{

	public function __construct(MassiveEconomyAPI $plugin){
        $this->plugin = $plugin;
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
    	$fcmd = strtolower($cmd->getName());
    	switch($fcmd){
    		case "setmoney":
    			if($sender->hasPermission("massiveeconomy.commands.setmoney")){
    				//Player Sender
    				if($sender instanceof Player){
    					if(isset($args[0])){
    						$args[0] = strtolower($args[0]);
    						if(isset($args[1])){
    							if(is_numeric($args[1])){
    								if(MassiveEconomyAPI::getInstance()->isPlayerRegistered($args[0])){
    									MassiveEconomyAPI::getInstance()->setMoney($args[0], $args[1]);
    									$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&6Money set to&2 " . $args[1] . MassiveEconomyAPI::getInstance()->getMoneySymbol() . " &6for player &4" . strtolower($args[0]) . "&6."));
    								}else{
    									$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&cPlayer not found."));
    									return true;
    								}
    							}else $sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&cUsage /setmoney <player> <amount>"));
    						}else{
    							if(is_numeric($args[0])){
    								if(MassiveEconomyAPI::getInstance()->isPlayerRegistered($sender->getName())){
    									MassiveEconomyAPI::getInstance()->setMoney($sender->getName(), $args[0]);
    									$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&6Money set to&2 " . $args[0] . MassiveEconomyAPI::getInstance()->getMoneySymbol() . " &6for player &4" . strtolower($sender->getName()) . "&6."));
    								}else{
    									$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&cYou aren't registered."));
    									return true;
    								}
    							}else $sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&cUsage /setmoney <amount>"));
    						}
    					}else{
    						$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&cUsage /setmoney <amount> or /setmoney <player> <amount>"));
    						break;
    					}
    			    //Console Sender
    				}else{
    					if(isset($args[0]) && isset($args[1]) && is_numeric($args[1])){
    						if(MassiveEconomyAPI::getInstance()->isPlayerRegistered($args[0])){
    							MassiveEconomyAPI::getInstance()->setMoney($args[0], $args[1]);
    							$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&6Money set to&2 " . $args[1] . MassiveEconomyAPI::getInstance()->getMoneySymbol() . " &6for player &4" . strtolower($args[0]) . "&6."));
    						}else{
    							$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&cPlayer not found."));
    							return true;
    						}
    					}else{
    						$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&cUsage /setmoney <player> <amount>"));
    						return true;
    					}
    				}
    				}else{
    					$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    					return true;
    				}
    			}
    		return true;
    	}
}
?>
