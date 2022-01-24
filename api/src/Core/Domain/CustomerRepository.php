<?php

declare(strict_types=1);

namespace PhoneNumberCategotization\Core\Domain;

use PhoneNumberCategotization\Core\Domain\Exception\UserNotFound;
use PhoneNumberCategotization\Framework\Id\Domain\Id;

interface CustomerRepository
{
    /** @return Customer[] */
    public function findAll(): array;
}
