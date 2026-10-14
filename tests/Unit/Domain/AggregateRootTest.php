<?php

declare(strict_types=1);

use Tests\Fixtures\Domain\SampleAggregateRoot;
use Tests\Fixtures\Domain\SampleDomainEvent;

it('is comparable by identity like any entity', function (): void {
    $aggregate = new SampleAggregateRoot('id-1');
    $same = new SampleAggregateRoot('id-1');
    $other = new SampleAggregateRoot('id-2');

    expect($aggregate->equals($same))->toBeTrue()
        ->and($aggregate->equals($other))->toBeFalse();
});

it('records domain events', function (): void {
    $aggregate = new SampleAggregateRoot('id-1');
    $event = new SampleDomainEvent;

    $aggregate->change($event);

    expect($aggregate->releaseDomainEvents())->toBe([$event]);
});

it('clears recorded domain events after releasing them', function (): void {
    $aggregate = new SampleAggregateRoot('id-1');

    $aggregate->change(new SampleDomainEvent);
    $aggregate->releaseDomainEvents();

    expect($aggregate->releaseDomainEvents())->toBe([]);
});
