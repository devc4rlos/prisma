<?php

declare(strict_types=1);

use Tests\Fixtures\Domain\AnotherSampleValueObject;
use Tests\Fixtures\Domain\SampleValueObject;

it('considers value objects with equal components equal', function (): void {
    $valueObject = new SampleValueObject('first', 1);
    $same = new SampleValueObject('first', 1);

    expect($valueObject->equals($same))->toBeTrue();
});

it('considers value objects with different components not equal', function (): void {
    $valueObject = new SampleValueObject('first', 1);
    $other = new SampleValueObject('first', 2);

    expect($valueObject->equals($other))->toBeFalse();
});

it('considers value objects of different types not equal', function (): void {
    $valueObject = new SampleValueObject('first', 1);
    $other = new AnotherSampleValueObject('first', 1);

    expect($valueObject->equals($other))->toBeFalse();
});
