<?php

declare(strict_types=1);

namespace Mencoreh\FasterProjectiles;

use pocketmine\event\entity\ProjectileLaunchEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {
    public int $multiplier;

    public function onEnable(): void {
        $this->multiplier = $this->getConfig()->get("speed-multiplier");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
    }

    public function onProjectileLaunch(ProjectileLaunchEvent $event): void {
        if($event->isCancelled()) return;

        $entity = $event->getEntity();
        $entity->setMotion($entity->getMotion()->multiply($this->multiplier));
    }
}

// Is this the shortest plugin in the history of Pocketmine?