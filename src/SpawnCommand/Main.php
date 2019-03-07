<?php
namespace SpawnCommand;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\Player;

class Main extends PluginBase implements Listener{
    public function onEnable(){
        $this->getserver()->getPluginManager()->registerEvents($this, $this);
        if(!is_dir($this->getDataFolder())){
            @mkdir($this->getDataFolder());
        }
        $config = new Config($this->getDataFolder()."config.yml", CONFIG::YAML, array(
            "SpawnMessage" => "§Teleported you successfully to Server Spawn!"
        ));
    }

    public function onCommand(CommandSender $sender, Command $command, $label, array $args) : bool{
        switch($command->getName()){
            case "spawn":
                if($sender instanceof Player){
                   $sender->teleport($this->getServer()->getDefaultLevel()->getSpawnLocation(), $this->getServer()->getDefaultLevel());
                    $sender->sendMessage(TextFormat::colorize("&aTeleported you to spawn."));
                    return true;
                    break;
                }
                    case "setspawn":
                    if($sender instanceof Player){
                     $sender->getLevel()->setSpawnLocation($sender);
        $sender->getServer()->setDefaultLevel($sender->getLevel());
                        $sender->sendMessage(TextFormat::colorize("&dServer spawn set successfully! &aUse &b/spawn &6to go to spawn!"));
                }else{
                    $sender->sendMessage("§cPlease run this command in-game.");
                }
                return true;
        }
    }
}
