<?php

declare(strict_types=1);

namespace Tests\Fixtures\Domain;

use Domain\Entity;

final class SampleEntity extends Entity
{
    public function __construct(private readonly string|int $id) {}

    public function identity(): string|int
    {
        return $this->id;
    }
}
