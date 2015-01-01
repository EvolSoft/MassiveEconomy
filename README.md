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

***For Users:***

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

***For Developers***

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

**API Functions***
