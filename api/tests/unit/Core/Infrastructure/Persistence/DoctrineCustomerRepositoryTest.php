<?php

declare(strict_types=1);

namespace PhoneNumberCategotization\Tests\Core\Infrastructure\Persistence;

use PhoneNumberCategotization\Core\Domain\Customer;
use PhoneNumberCategotization\Core\Domain\Phone;
use PhoneNumberCategotization\Core\Infrastructure\Persistence\DoctrineCustomerRepository;
use PhoneNumberCategotization\Tests\Core\DoctrineTestCase;

class DoctrineCustomerRepositoryTest extends DoctrineTestCase
{
    public function test_find_all_customers(): void
    {
        $customers = $this->customers();
        $repository = new DoctrineCustomerRepository($this->entityManager);

        $customersFound = $repository->findAll();

        $this->assertEquals($customers, $customersFound);
    }

    private function customers(): array
    {
        $customers = [
            Customer::create(0 , 'Walid Hammadi', Phone::create('(212) 6007989253')),
            Customer::create(10, 'Tanvi Sachdeva', Phone::create('(258) 84330678235')),
            Customer::create(19, 'Ogwal David', Phone::create('(256) 7771031454')),
            Customer::create(23, 'Filimon Embaye', Phone::create('(251) 914701723')),
            Customer::create(23, 'Filimon Embaye', Phone::create('(251) 123914701723')),
            Customer::create(32, 'MICHAEL MICHAEL', Phone::create('(237) 677046616')),
        ];

        foreach ($customers as $customer) {
            $this->entityManager->persist($customer);
        }

        $this->entityManager->flush();
        $this->entityManager->clear();

        return $customers;
    }
}