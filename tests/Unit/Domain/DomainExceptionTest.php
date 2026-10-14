<?php

declare(strict_types=1);

use Domain\DomainException;

it('is a runtime exception carrying a message', function (): void {
    $exception = new DomainException('Invariant broken');

    expect($exception)
        ->toBeInstanceOf(RuntimeException::class)
        ->and($exception->getMessage())->toBe('Invariant broken');
});

it('can be extended to express a specific rule violation', function (): void {
    $exception = new class extends DomainException {};

    expect($exception)->toBeInstanceOf(DomainException::class);
});
