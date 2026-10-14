<?php

declare(strict_types=1);

use Tests\Fixtures\Domain\AnotherSampleEntity;
use Tests\Fixtures\Domain\SampleEntity;

it('exposes its identity', function (): void {
    expect((new SampleEntity('abc'))->identity())->toBe('abc');
});

it('considers entities with the same type and identity equal', function (): void {
    $entity = new SampleEntity(1);
    $same = new SampleEntity(1);

    expect($entity->equals($same))->toBeTrue();
});

it('considers entities with different identities not equal', function (): void {
    $entity = new SampleEntity(1);
    $other = new SampleEntity(2);

    expect($entity->equals($other))->toBeFalse();
});

it('considers entities of different types not equal', function (): void {
    $entity = new SampleEntity(1);
    $other = new AnotherSampleEntity(1);

    expect($entity->equals($other))->toBeFalse();
});
