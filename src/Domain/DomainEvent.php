<?php

declare(strict_types=1);

namespace Domain;

/**
 * Marker contract for domain events.
 *
 * A domain event describes something meaningful that happened in the domain.
 * Aggregate roots record them so they can be dispatched after the aggregate
 * has been persisted, keeping side effects out of the domain model.
 */
interface DomainEvent {}
