<?php

declare(strict_types=1);

namespace Domain;

/**
 * Base class for domain entities.
 *
 * An entity is defined by a stable identity that persists across state
 * changes, rather than by the values it holds. Two entities of the same
 * concrete type are equal when they share the same identity.
 */
abstract class Entity
{
    /**
     * Return the stable identity of the entity.
     */
    abstract public function identity(): string|int;

    /**
     * Determine whether this entity refers to the same one as the given entity.
     *
     * Equality requires both a matching concrete type and a matching identity.
     */
    public function equals(Entity $other): bool
    {
        return $this::class === $other::class
            && $this->identity() === $other->identity();
    }
}
