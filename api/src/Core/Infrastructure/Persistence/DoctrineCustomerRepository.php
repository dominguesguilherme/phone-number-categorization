<?php

declare(strict_types=1);

namespace PhoneNumberCategotization\Core\Infrastructure\Persistence;

use Doctrine\Persistence\ObjectManager;
use PhoneNumberCategotization\Core\Domain\Customer;
use PhoneNumberCategotization\Core\Domain\CustomerRepository;

class DoctrineCustomerRepository implements CustomerRepository
{
    private const ENTITY = Customer::class;

    public function __construct(
        private ObjectManager $objectManager,
    ) { }

    public function findAll(): array
    {
        return $this->objectManager->getRepository(self::ENTITY)->findAll();
    }
}
