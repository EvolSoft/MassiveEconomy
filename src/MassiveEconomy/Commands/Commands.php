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

class Commands extends PluginBase implements CommandExecutor{

	public function __construct(MassiveEconomyAPI $plugin){
        $this->plugin = $plugin;
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
    	$fcmd = strtolower($cmd->getName());
    	switch($fcmd){
    		case "massiveeconomy":
    			if(isset($args[0])){
    				$args[0] = strtolower($args[0]);
    				if($args[0]=="help"){
    					if($sender->hasPermission("massiveeconomy.commands.help")){
    						$sender->sendMessage($this->plugin->translateColors("&", "&6-> &4Available Commands &6<-"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&4/meco info &6-> Show info about this plugin"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&4/meco reload &6-> Reload the config"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&4/money &6-> Show your money"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&4/pay &6-> Pay a player"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&4/setmoney &6-> Set player money"));
    						break;
    					}else{
    						$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    						break;
    					}
    				}elseif($args[0]=="info"){
    					if($sender->hasPermission("massiveeconomy.commands.info")){
    						$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&6MassiveEconomy &4v" . MassiveEconomyAPI::VERSION . " &6developed by&4 " . MassiveEconomyAPI::PRODUCER));
    			   	        $sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&6Website &4" . MassiveEconomyAPI::MAIN_WEBSITE));
    				        break;
    					}else{
    						$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    						break;
    					}
    				}elseif($args[0]=="reload"){
    					if($sender->hasPermission("massiveeconomy.commands.reload")){
    						$this->plugin->reloadConfig();
    						$sender->sendMessage($this->plugin->translateColors("&", MassiveEconomyAPI::PREFIX . "&aConfiguration Reloaded."));
    				        break;
    					}else{
    						$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    						break;
    					}
    				}
    				}else{
    					if($sender->hasPermission("massiveeconomy.commands.help")){
    						$sender->sendMessage($this->plugin->translateColors("&", "&6-> &4Available Commands &6<-"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&4/meco info &6-> Show info about this plugin"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&4/meco reload &6-> Reload the config"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&4/money &6-> Show your money"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&4/pay &6-> Pay a player"));
    						$sender->sendMessage($this->plugin->translateColors("&", "&4/setmoney &6-> Set player money"));
    						break;
    					}else{
    						$sender->sendMessage($this->plugin->translateColors("&", "&cYou don't have permissions to use this command"));
    						break;
    					}
    				}
    			}
    	}
}
?>
