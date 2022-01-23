<?php

declare(strict_types=1);

namespace PhoneNumberCategotization\Core\Infrastructure\Persistence;

use PhoneNumberCategotization\Core\Domain\Customer;
use PhoneNumberCategotization\Core\Domain\CustomerRepository;

class InMemoryCustomerRepository implements CustomerRepository
{
    /** @param Customer[] $customers */
    public function __construct(
        private array $customers = [],
    ) { }

    public function findWithPagination(): array
    {
        return $this->customers;
    }
}
