<?php

declare(strict_types=1);

namespace Domain;

/**
 * Base class for domain value objects.
 *
 * A value object is immutable and has no identity: two instances of the same
 * concrete type are equal when all of their components are equal. Subclasses
 * describe their state through {@see self::components()}, which keeps equality
 * defined in one place.
 */
abstract class ValueObject
{
    /**
     * Scalar components that fully describe and compare this value object.
     *
     * @return array<string, scalar|null>
     */
    abstract protected function components(): array;

    /**
     * Determine whether this value object is equal to the given one.
     */
    public function equals(ValueObject $other): bool
    {
        return $this::class === $other::class
            && $this->components() === $other->components();
    }
}
