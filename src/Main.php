<?php

declare(strict_types=1);

namespace Mencoreh\FasterProjectiles;

use pocketmine\entity\projectile\Projectile;
use pocketmine\event\entity\ProjectileLaunchEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\event\entity\EntityMotionEvent;


class Main extends PluginBase implements Listener {
    public int|float $multiplier;

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

    public function onEntityMotion(EntityMotionEvent $event): void
    {
        $entity = $event->getEntity();
        if ($entity instanceof Projectile && !$event->isCancelled()) {
            $motion = $entity->getMotion();
            $motion->y -= 0.1;
            $entity->setMotion($motion);
        }
    }
}

// Is this the shortest plugin in the history of Pocketmine?