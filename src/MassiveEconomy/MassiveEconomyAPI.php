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
use pocketmine\command\CommandExecutor;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;
use pocketmine\Player;

class MassiveEconomyAPI extends PluginBase{
	
	//About Plugin Const
	const PRODUCER = "EvolSoft";
	const VERSION = "1.0 R3";
	const MAIN_WEBSITE = "http://www.evolsoft.tk";
	//Other Const
	//Prefix
	const PREFIX = "&2[&6$&6MassiveEconomy&6$&2] ";
	
    public $cfg;
    
    public $data;
    
    private static $object = null;
    
    public static function getInstance(){
    	return self::$object;
    }
    
    public function onLoad(){
    	if(!self::$object instanceof MassiveEconomy){
    		self::$object = $this;
    	}
       	$this->data = $this->getDataFolder();
    }

    public function translateColors($symbol, $message){
    
    	$message = str_replace($symbol."0", TextFormat::BLACK, $message);
    	$message = str_replace($symbol."1", TextFormat::DARK_BLUE, $message);
    	$message = str_replace($symbol."2", TextFormat::DARK_GREEN, $message);
    	$message = str_replace($symbol."3", TextFormat::DARK_AQUA, $message);
    	$message = str_replace($symbol."4", TextFormat::DARK_RED, $message);
    	$message = str_replace($symbol."5", TextFormat::DARK_PURPLE, $message);
    	$message = str_replace($symbol."6", TextFormat::GOLD, $message);
    	$message = str_replace($symbol."7", TextFormat::GRAY, $message);
    	$message = str_replace($symbol."8", TextFormat::DARK_GRAY, $message);
    	$message = str_replace($symbol."9", TextFormat::BLUE, $message);
    	$message = str_replace($symbol."a", TextFormat::GREEN, $message);
    	$message = str_replace($symbol."b", TextFormat::AQUA, $message);
    	$message = str_replace($symbol."c", TextFormat::RED, $message);
    	$message = str_replace($symbol."d", TextFormat::LIGHT_PURPLE, $message);
    	$message = str_replace($symbol."e", TextFormat::YELLOW, $message);
    	$message = str_replace($symbol."f", TextFormat::WHITE, $message);
    
    	$message = str_replace($symbol."k", TextFormat::OBFUSCATED, $message);
    	$message = str_replace($symbol."l", TextFormat::BOLD, $message);
    	$message = str_replace($symbol."m", TextFormat::STRIKETHROUGH, $message);
    	$message = str_replace($symbol."n", TextFormat::UNDERLINE, $message);
    	$message = str_replace($symbol."o", TextFormat::ITALIC, $message);
    	$message = str_replace($symbol."r", TextFormat::RESET, $message);
    
    	return $message;
    }
    
    public function onEnable(){
	    @mkdir($this->getDataFolder());
	    @mkdir($this->getDataFolder() . "users/");
        $this->saveDefaultConfig();
        $this->data = $this->getDataFolder();
        $this->cfg = $this->getConfig()->getAll();
        $this->getCommand("massiveeconomy")->setExecutor(new Commands\Commands($this));
        $this->getCommand("money")->setExecutor(new Commands\Money($this));
        $this->getCommand("pay")->setExecutor(new Commands\Pay($this));
        $this->getCommand("setmoney")->setExecutor(new Commands\SetMoney($this));
        $this->getServer()->getPluginManager()->registerEvents(new RegisterEvent($this), $this);
    }
    
    //API Functions
    //API Version Const
    const API_VERSION = "0.90";
    
    //Get Money Symbol
    
    public function getMoneySymbol(){
    	$this->cfg = new Config($this->data . "config.yml", Config::YAML);
    	return $this->cfg->get('money-symbol');
    }
    
    //Get Default Money
    
    public function getDefaultMoney(){
    	$this->cfg = new Config($this->data . "config.yml", Config::YAML);
    	return $this->cfg->get('default-money');
    }
    
    //Get Minimum Money
    
    public function getMinimumMoney(){
    	$this->cfg = new Config($this->data . "config.yml", Config::YAML);
    	return $this->cfg->get('min-money');
    }
    
    //Get Version
    
    public function getVersion(){
    	return MassiveEconomyAPI::VERSION;
    }
    
    //Get API Version
    
    public function getAPIVersion(){
    	return MassiveEconomyAPI::API_VERSION;
    }
    
    //Register Player
    
    public function RegisterPlayer(Player $player){
    	$data = new Config($this->data . "users/" . strtolower($player->getName() . ".yml"), Config::YAML);
    	$data->set("money", "");
    	$data->save();
    }
    
    //Is Player Registered
    
    public function isPlayerRegistered($player){
    	return file_exists($this->data . "users/" . strtolower($player . ".yml"));
    }
    
    //Get-Set Money
    
    public function getMoney($player){
    	if($this->isPlayerRegistered($player)){
    		$data = new Config($this->data . "users/" . strtolower($player . ".yml"), Config::YAML);
    		return $data->get("money");
    	}else{
    		return false; //Failed: Player not registered
    	}
    }
    
    public function setMoney($player, $amount){
    	if($this->isPlayerRegistered($player)){
    		$data = new Config($this->data . "users/" . strtolower($player . ".yml"), Config::YAML);
    		$data->set("money", $amount);
    		$data->save();
    		return true; //Success!
    	}else{
    		return false; //Failed: Player not registered
    	}
    }
    
    //PayPlayer
    
    public function payPlayer($receiver, $amount){
    	if($this->isPlayerRegistered($receiver)){
    		$data = new Config($this->data . "users/" . strtolower($receiver . ".yml"), Config::YAML);
    		$data->set("money", $this->getMoney($receiver)+$amount);
    		$data->save();
    		return true; //Success!
    	}else{
    		return false; //Failed: Player not registered
    	}
    }
    
    //SendMoney to Player
    
    public function payMoneyToPlayer($sender, $amount, $receiver){
    	if($this->isPlayerRegistered($sender)){
    		if($this->isPlayerRegistered($receiver)){
    			$sdata = new Config($this->data . "users/" . strtolower($sender . ".yml"), Config::YAML);
    			$rdata = new Config($this->data . "users/" . strtolower($receiver . ".yml"), Config::YAML);
    			if($amount <= $this->getMoney($sender)){
    				$sdata->set("money", $this->getMoney($sender)-$amount);
    				$sdata->save();
    				$rdata->set("money", $this->getMoney($receiver)+$amount);
    				$rdata->save();
    				return 3; //Success!
    			}else{
    				return 2; //Failed: Not enough money
    			}
    		}else{
    			return 1; //Failed: Player (receiver) not registered
    		}
    	}else{
    		return 0; //Failed: Player (sender) not registered
    	}
    }
    
    //TakeMoney
    
    public function takeMoney($player, $amount){
    	if($this->isPlayerRegistered($player)){
    		$data = new Config($this->data . "users/" . strtolower($player . ".yml"), Config::YAML);
    		if($this->getMoney($player)-$amount >= $this->getMinimumMoney()){
    			$data->set("money", $this->getMoney($player)-$amount);
    			$data->save();
    			return 2; //Success!
    		}else{
    			return 1; //Failed: Not enough money
    		}
    	}else{
    		return 0; //Failed: Player not registered
    	}
    }
}
?>
