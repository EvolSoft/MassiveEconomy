# MassiveEconomy

Advanced Economy Plugin + API for PocketMine-MP

## Category

PocketMine-MP plugins

## Requirements

PocketMine-MP Alpha_1.4 API 1.9.0

## Overview

**MassiveEconomy** is an advanced economy plugin.

**EvolSoft Website:** http://www.evolsoft.tk

***This Plugin uses the New API. You can't install it on old versions of PocketMine.***

Manage your Server Economy with MassiveEconomy.<br>
With MassiveEconomy you can customize minimum money, money symbol, first join money... (read documentation)<br>
MassiveEconomy includes also an advanced API which you can create your plugins.<br>

**What is included?**

In the ZIP file you will find:<br>
*- MassiveEconomy_v1.0 R3.phar : MassiveEconomy Plugin + API*<br>
*- MassiveEconomyExample_v1.phar : MassiveEconomy API implementation example*<br>
*- MassiveEconomyExample : Example Plugin source code*<br>

**Commands:**

<dd><i><b>/massiveeconomy</b> - MassiveEconomy commands</i></dd>
<dd><i><b>/money</b> - Show your money</i></dd>
<dd><i><b>/pay</b> - Pay a player</i></dd>
<dd><i><b>/setmoney</b> - Set player money</i></dd>

<br>
**To-Do:**
<br><br>
*- Bug fix (if bugs will be found)*
*- MySQL support*

## Documentation

#### For Users:

**Configuration (config.yml):**
```yaml
---
#Money Symbol
money-symbol: "$"
#Default money when a player joins for first time (he must have the permission: massiveeconomy.receivedefault)
default-money: 500
#Minimum money that the player can have (you can use also negative numbers)
min-money: 0
...
```

**Commands:**

***/massiveeconomy*** *- MassiveEconomy commands (aliases: [meco, massiveeco, me])*<br>
***/money &lt;player (optional)&gt;*** *- Show your money (or player's money)*<br>
***/pay &lt;player&gt; &lt;amount&gt;*** *- Pay a player*<br>
***/setmoney &lt;player&gt; &lt;amount&gt;*** *- Set player money*<br>


**Permissions:**

- <dd><i><b>massiveeconomy.*</b> - MassiveEconomy permissions.</i></dd>
- <dd><i><b>massiveeconomy.receivedefault</b> - Receive default money permission.</i></dd>
- <dd><i><b>massiveeconomy.commands.help</b> - MassiveEconomy command Help permission.</i></dd>
- <dd><i><b>massiveeconomy.commands.info</b> - MassiveEconomy command Info permission.</i></dd>
- <dd><i><b>massiveeconomy.commands.reload</b> - MassiveEconomy command Reload permission.</i></dd>
- <dd><i><b>massiveeconomy.commands.setmoney</b> - MassiveEconomy command SetMoney permission.</i></dd>
- <dd><i><b>massiveeconomy.commands.pay</b> - MassiveEconomy command Pay permission.</i></dd>
- <dd><i><b>massiveeconomy.commands.money</b> - MassiveEconomy command Money permission.</i></dd>
- <dd><i><b>massiveeconomy.commands.money.others</b> - Show other players' money permission.</i></dd>

#### For Developers

**Basic Tutorial:**

*1. Define the plugin dependency in plugin.yml:*
```yaml
depend: [MassiveEconomy]
```
*2. Include MassiveEconomy API in your php code:*
```php
use MassiveEconomy\MassiveEconomyAPI;
```
*3. Check if MassiveEconomy API is compatible (insert this code in onEnable() function)*
```php
if(MassiveEconomyAPI::getInstance()->getAPIVersion() == "(used API version)"){
            //API compatible
        }else{
            //API not compatible
            $this->getPluginLoader()->disablePlugin($this);
        }
```
*4. Call the API function:*
```php
MassiveEconomyAPI::getInstance()->(API function);
```
***A full plugin example using MassiveEconomy API is included in the ZIP file.***

**API Functions:**

###### Get Money Symbol:
```php
string getMoneySymbol()
```
**Description:**<br>
Get money symbol (defined in config).<br>
**Return:**<br>
money symbol

###### Get Default Money:
```php
int getDefaultMoney()
```
**Description:**<br>
Get default money (defined in config).<br>
**Return:**<br>
default money

###### Get Minimum Money:
```php
int getMinimumMoney()
```
**Description:**<br>
Get minimum money (defined in config).<br>
**Return:**<br>
minimum money

###### Get Version:
```php
string getVersion()
```
**Description:**<br>
Get the MassiveEconomy plugin version.<br>
**Return:**<br>
plugin version

###### Get API Version:
```php
string getAPIVersion()
```
**Description:**<br>
Get the MassiveEconomy API version.<br>
**Return:**<br>
plugin API version

###### Register Player:
```php
void RegisterPlayer(Player $player)
```
**Description:**<br>
Register a player to MassiveEconomy.<br>
**Parameters:**<br>
*$player* **must** be the **Player** (pocketmine/Player)

###### Check if a Player is registered:
```php
boolean isPlayerRegistered($player)
```
**Description:**<br>
Check if a player is registered to MassiveEconomy.<br>
**Parameters:**<br>
*$player* **must** be the **player name**<br>
**Return:**<br>
*true* if the player is registered<br>
*false* if the player isn't registered

###### Get Money:
```php
int|boolean getMoney($player)
```
**Description:**<br>
Get player money.<br>
**Parameters:**<br>
*$player* **must** be the **player name**<br>
**Return:**<br>
*player money* if the player is registered<br>
*false* if the player isn't registered

###### Set Money:
```php
boolean setMoney($player, $amount)
```
**Description:**<br>
Set player money.<br>
**Parameters:**<br>
*$player* **must** be the **player name**<br>
*$amount* the amount (**must** be a **number**)<br>
**Return:**<br>
*player money* if the player is registered<br>
*false* if the player isn't registered

###### Pay Player:
```php
boolean payPlayer($receiver, $amount)
```
**Description:**<br>
Pay a player.<br>
**Parameters:**<br>
*$receiver* **must** be the **player name**<br>
*$amount* the amount (**must** be a **number**)<br>
**Return:**<br>
*true* if the player is registered<br>
*false* if the player isn't registered

###### Pay Player from Player
```php
int payMoneyToPlayer($sender, $amount, $receiver)
```
**Description:**<br>
Pay money to player from another player.<br>
**Parameters:**<br>
*$sender* **must** be the **player name**<br>
*$amount* the amount (**must** be a **number**)<br>
*$receiver* **must** be the **player name**<br>
**Return:**<br>
*3* success<br>
*2* if the sender hasn't enough money<br>
*1* if the receiver isn't registered<br>
*0* if the sender isn't registered

###### Take Money:
```php
int takeMoney($player, $amount)
```
**Description:**<br>
Take Money from Player.<br>
**Parameters:**<br>
*$player* **must** be the **player name**<br>
*$amount* the amount (**must** be a **number**)<br>
**Return:**<br>
*2* success<br>
*1* if the sender hasn't enough money<br>
*0* if the receiver isn't registered
