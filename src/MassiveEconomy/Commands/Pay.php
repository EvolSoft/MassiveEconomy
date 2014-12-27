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

class Pay extends PluginBase implements CommandExecutor{

	public function __construct(MassiveEconomyAPI $plugin){
        $this->plugin = $plugin;
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
    	$fcmd = strtolower($cmd->getName());
    	switch($fcmd){
    		case "pay":
    			if($sender->hasPermission("massiveeconomy.commands.pay")){
    				//Player Sender
    				if($sender instanceof Player){
    					if(isset($args[0]) && isset($args[1])){
    						$args[0] = strtolower($args[0]);
    							if(is_numeric($args[1])){
    								if(MassiveEconomyAPI::getInstance()->isPlayerRegistered($sender->getName()) && MassiveEconomyAPI::getInstance()->isPlayerRegistered($args[0])){
    									//Checking Payment
    									$status = MassiveEconomyAPI::getInstance()->payMoneyToPlayer($sender->getName(), $args[1], $args[0]);
    									if($status==3){
    										$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&6You paid &4" . $args[1] . MassiveEconomyAPI::getInstance()->getMoneySymbol() . " &6to &2" . strtolower($args[0])));
    										//Sending Message to receiver
    										if($this->plugin->getServer()->getPlayer($args[0])){
    											$rec = $this->plugin->getServer()->getPlayer($args[0]);
    											$rec->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&2You received " . $args[1] . MassiveEconomyAPI::getInstance()->getMoneySymbol() . " from " . $sender->getName()));
    										}
    									}elseif($status==2){
    										$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&cYou don't have enough money"));
    									}
    								}else{
    									$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&cPlayer not found."));
    									return true;
    								}
    							}else $sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&cUsage /pay <player> <amount>"));
    						}else{
    							$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&cUsage /pay <player> <amount>"));
    							return true;
    						}
    			    //Console Sender
    				}else{
    					if(isset($args[0]) && isset($args[1])){
    						$args[0] = strtolower($args[0]);
    						if(is_numeric($args[1])){
    							if(MassiveEconomyAPI::getInstance()->isPlayerRegistered($args[0])){
    								MassiveEconomyAPI::getInstance()->payPlayer($args[0], $args[1]);
    								$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&6You paid &4" . $args[1] . MassiveEconomyAPI::getInstance()->getMoneySymbol() . " &6to &2" . strtolower($args[0])));
    								//Sending Message to receiver
    								if($this->plugin->getServer()->getPlayer($args[0])){
    									$rec = $this->plugin->getServer()->getPlayer($args[0]);
    									$rec->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&2You received " . $args[1] . MassiveEconomyAPI::getInstance()->getMoneySymbol()));
    								}
    							}else{
    								$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&cPlayer not found."));
    								return true;
    							}
    						}else $sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&cUsage /pay <player> <amount>"));
    					}else{
    						$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&cUsage /pay <player> <amount>"));
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
