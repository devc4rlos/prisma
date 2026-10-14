<?php

declare(strict_types=1);

namespace Domain;

/**
 * Base class for aggregate roots.
 *
 * An aggregate root is the single entry point to a consistency boundary and
 * the only entity inside an aggregate that external code may reference or
 * persist directly. It records domain events that describe the changes applied
 * to the aggregate so they can be published once it is persisted.
 */
abstract class AggregateRoot extends Entity
{
    /**
     * Domain events recorded but not yet released.
     *
     * @var list<DomainEvent>
     */
    private array $domainEvents = [];

    /**
     * Record a domain event raised by this aggregate.
     */
    final protected function recordThat(DomainEvent $event): void
    {
        $this->domainEvents[] = $event;
    }

    /**
     * Release and clear every recorded domain event.
     *
     * @return list<DomainEvent>
     */
    final public function releaseDomainEvents(): array
    {
        $events = $this->domainEvents;

        $this->domainEvents = [];

        return $events;
    }
}
