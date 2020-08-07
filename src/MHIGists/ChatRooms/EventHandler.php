<?php


namespace MHIGists\ChatRooms;


use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class EventHandler implements Listener
{
    private $main;

    public function __construct(Main $main)
    {
        $this->main = $main;
    }

    public function chat_event(PlayerChatEvent $event)
    {
        $player = $event->getPlayer();
        $player_chat = $this->main->getPlayerChat($player->getName());
        if ($this->main->getPlayerChat($player) == false) {
            $this->main->chat_rooms['global'][] = $player->getName();
        }
       $event->setRecipients($this->main->chat_rooms[$player_chat]);
        $prefix = "[$player_chat]";
        if ($this->main->pure_chat != null)
        {
            $pure_chat_format = $this->main->pure_chat->getChatFormat($player, $event->getMessage());
            $prefix = $this->main->getPrefix($player_chat) . $pure_chat_format;
        }
        $event->setFormat($prefix);

    }
}