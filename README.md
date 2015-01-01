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

/massiveeconomy - MassiveEconomy commands (aliases: [meco, massiveeco, me])
/money <player (optional)> - Show your money (or player's money)
/pay <player> <amount> - Pay a player
/setmoney <player> <amount> - Set player money


**Permissions:**

- massiveeconomy.* - MassiveEconomy permissions.
- massiveeconomy.receivedefault - Receive default money permission.
- massiveeconomy.commands.help - MassiveEconomy command Help permission.
- massiveeconomy.commands.info - MassiveEconomy command Info permission.
- massiveeconomy.commands.reload - MassiveEconomy command Reload permission.
- massiveeconomy.commands.setmoney - MassiveEconomy command SetMoney permission.
- massiveeconomy.commands.pay - MassiveEconomy command Pay permission.
- massiveeconomy.commands.money - MassiveEconomy command Money permission.
- massiveeconomy.commands.money.others - Show other players' money permission.
