<?php

declare(strict_types = 1);

namespace Aggrego\Domain\Event\Model\Entity;

use Aggrego\Domain\Event\Event;
use Aggrego\Domain\Event\Events;

trait TraitAggregate
{
    /** @var Events */
    protected $events;

    private function initEvents(): void
    {
        if (is_null($this->events)) {
            $this->events = new Events();
        }
    }

    public function pullEvents(): Events
    {
        $this->initEvents();
        return $this->events;
    }

    protected function pushEvent(Event $event): void
    {
        $this->initEvents();
        $this->events->add($event);
    }
}
