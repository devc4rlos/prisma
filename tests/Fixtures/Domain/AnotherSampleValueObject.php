<?php

declare(strict_types=1);

namespace Tests\Fixtures\Domain;

use Domain\ValueObject;

final class AnotherSampleValueObject extends ValueObject
{
    public function __construct(
        private readonly string $first,
        private readonly int $second,
    ) {}

    protected function components(): array
    {
        return [
            'first' => $this->first,
            'second' => $this->second,
        ];
    }
}
