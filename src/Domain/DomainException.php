<?php

declare(strict_types=1);

namespace Domain;

use RuntimeException;

/**
 * Base exception for domain rule violations.
 *
 * A domain exception signals that a business invariant has been broken and
 * belongs to the ubiquitous language of the domain. Concrete rules should
 * extend this class with a descriptive, intention-revealing name.
 */
class DomainException extends RuntimeException {}
