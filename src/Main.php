<?php

declare(strict_types=1);

namespace Mencoreh\FasterProjectiles;

use pocketmine\event\entity\ProjectileLaunchEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;


class Main extends PluginBase implements Listener {
    public int|float $multiplier;
    public int|float $gravity;

    public function onEnable(): void {
        $this->multiplier = $this->getConfig()->get("speed-multiplier");
        $this->gravity = $this->getConfig()->get("gravity-increase");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
    }

    public function onProjectileLaunch(ProjectileLaunchEvent $event): void {
        if($event->isCancelled()) return;
        $entity = $event->getEntity();
        $entity->setGravity($entity->getGravity() * $this->gravity);
        $entity->setMotion($entity->getMotion()->multiply($this->multiplier));
    }
}

// Is this the shortest plugin in the history of Pocketmine?