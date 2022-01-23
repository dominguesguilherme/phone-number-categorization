<?php

declare(strict_types=1);

namespace PhoneNumberCategotization\Tests\Core\Domain;

use PhoneNumberCategotization\Core\Domain\Phone;
use PHPUnit\Framework\TestCase;
use PhoneNumberCategotization\Core\Domain\Exception\InsufficientBalance;
use PhoneNumberCategotization\Core\Domain\Customer;

class CustomerTest extends TestCase
{
    public function test_create_should_create_an_instance_of_customer(): void
    {
        $id = 1;
        $name = 'Edunildo Gomes Alberto';
        $phone = Phone::create('(212) 6007989253');

        $customer = Customer::create($id, $name, $phone);

        $this->assertEquals($id, $customer->id());
        $this->assertEquals($name, $customer->name());
        $this->assertEquals($phone, $customer->phone());
    }
}
