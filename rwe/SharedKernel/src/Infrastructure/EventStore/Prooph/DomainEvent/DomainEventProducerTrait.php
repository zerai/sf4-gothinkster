<?php

declare(strict_types=1);

namespace SharedKernel\Infrastructure\EventStore\Prooph\DomainEvent;

use Prooph\Common\Messaging\DomainEvent;

trait DomainEventProducerTrait
{
    /**
     * Current version.
     *
     * @var int
     */
    protected $version = 0;

    /**
     * List of events that are not committed to the EventStore.
     *
     * @var DomainEvent[]
     */
    protected $recordedEvents = [];

    /**
     * Get pending events and reset stack.
     *
     * @return DomainEvent[]
     */
    //protected function popRecordedEvents(): array
    public function popRecordedEvents(): array
    {
        $pendingEvents = $this->recordedEvents;

        $this->recordedEvents = [];

        return $pendingEvents;
    }

    /**
     * Record an aggregate changed event.
     *
     * @param DomainEvent $event
     */
    protected function recordThat(DomainEvent $event): void
    {
        ++$this->version;

        $this->recordedEvents[] = $event; //->withVersion($this->version);

        //$this->apply($event);
    }

    abstract protected function aggregateId(): string;

    /*
     * Apply given event.
     */
    //abstract protected function apply(DomainEvent $event): void;
}
