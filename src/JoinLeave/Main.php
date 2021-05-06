<?php

namespace JoinLeave;

use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\event;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener
{
    public function onEnable()
    {
        $this->getlogger()->info("JoinLeave by GeistFan");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $this->getResource("config.yml");
        
    }
    public function onPlayerJoin(PlayerJoinEvent $event)
    {
        $join = $this->getConfig()->get("join");
        $player = $event->getPlayer()->getName();
        $event->setJoinMessage(str_replace("{name}",$player,$join));
    }

    public function onPlayerQuit(PlayerQuitEvent $event)
    {
        $leave = $this->getConfig()->get("leave");
        $player = $event->getPlayer()->getName();
        $event->setQuitMessage(str_replace("{name}",$player,$leave));
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args):bool
    {
        if($cmd->getName() === "tjl")
        {
            if($sender->hasPermission("JoinLeaveTest.cmd"))
            {
                $sender->sendMessage("JoinLeave ist Aktiv!");
            }
        }return true;
    }

}
