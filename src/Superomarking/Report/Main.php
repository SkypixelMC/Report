<?php

namespace Superomarking\Report;

use pocketmine\event\Listener;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;

use pocketmine\plugin\PluginBase;

use pocketmine\Player;

use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {

    public $prefix = "SkyPixel Report ";

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info(TextFormat::GREEN . "Report by Superomarking Enabled");
    }
    public function onDisable(){
        $this->getLogger()->info(TextFormat::RED . "Report by Superomarking Disabled");
    }
    public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args) : bool {
        switch($cmd->getName()){
            case "report":
                if(!$sender instanceof Player){
                    $sender->sendMessage(TextFormat::RED . "Please Use This Command In Game");
                } else {
                    if(empty($args[0])){
                        $sender->sendMessage(TextFormat::RED . "Usage: /report <player> <reason>");
                        return true;
                    } else {
                        if(empty($args[1])){
                            $sender->sendMessage(TextFormat::RED . "Usage: /report <player> <reason>");
                            return true;
                        } else {
                            if($this->getServer()->getPlayer($args[0]) instanceof Player){
                                $sender->sendMessage(TextFormat::GREEN . "Thank You For Your Report");
                                foreach($this->getServer()->getOnlinePlayers() as $players){
                                    if($players->hasPermission("report.sender")){
                                        $players->sendMessage($prefix . TextFormat::GREEN . $args[0] . " was reported by ". $sender->getName() . " for ". $args[1]);
                                    }
                                }
                            } else {
                            	$sender->sendMessage(TextFormat::RED . $args[0] . " Is Not Online Right Now"); 
                            }
                        }
                    }
                }
        }
        return true;
    }
}