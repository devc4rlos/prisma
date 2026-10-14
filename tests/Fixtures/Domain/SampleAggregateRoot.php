<?php

declare(strict_types=1);

namespace Tests\Fixtures\Domain;

use Domain\AggregateRoot;
use Domain\DomainEvent;

final class SampleAggregateRoot extends AggregateRoot
{
    public function __construct(private readonly string $id) {}

    public function identity(): string|int
    {
        return $this->id;
    }

    public function change(DomainEvent $event): void
    {
        $this->recordThat($event);
    }
}
