<?php

declare(strict_types=1);

namespace PhoneNumberCategotization\Tests\Core\Infrastructure\Persistence;

use PhoneNumberCategotization\Core\Application\FetchCategorizedPhoneNumbers;
use PhoneNumberCategotization\Core\Application\FetchCategorizedPhoneNumbersHandler;
use PhoneNumberCategotization\Core\Domain\Customer;
use PhoneNumberCategotization\Core\Domain\CustomerRepository;
use PhoneNumberCategotization\Core\Domain\Phone;
use PhoneNumberCategotization\Core\Infrastructure\Persistence\InMemoryCustomerRepository;
use PHPUnit\Framework\TestCase;

class FetchCategorizedPhoneNumbersHandlerTest extends TestCase
{
    private CustomerRepository $customerRepository;
    private FetchCategorizedPhoneNumbersHandler $handler;

    protected function setUp(): void
    {
        $this->customerRepository = new InMemoryCustomerRepository($this->data());
        $this->handler = new FetchCategorizedPhoneNumbersHandler($this->customerRepository);
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    /** @dataProvider providesSuccessScenarios */
    public function test_invoke_should_return_categorized_phone_numbers(array $expectedCategorizedNumbers): void
    {
        $categorizedNumbers = $this->handler->__invoke(new FetchCategorizedPhoneNumbers());

        $this->assertEquals($expectedCategorizedNumbers, $categorizedNumbers);
    }

    public function providesSuccessScenarios(): array
    {
        return [
            [
                'expectedCategorizedNumbers' => [
                    [
                        'country' => '',
                        'state' => '',
                        'country_code' => '',
                        'phone_number' => ''
                    ],
                ],
            ],
        ];
    }

    /** @return Customer[] */
    private function data(): array
    {
        return [
            Customer::create(0 , 'Walid Hammadi', Phone::create('(212) 6007989253')),
            /*
            Customer::create(1 , 'Yosaf Karrouch', Phone::create('(212) 698054317')),
            Customer::create(9 , 'sevilton sylvestre', Phone::create('(258) 849181828')),
            Customer::create(10, 'Tanvi Sachdeva', Phone::create('(258) 84330678235')),
            Customer::create(19, 'Ogwal David', Phone::create('(256) 7771031454')),
            Customer::create(20, 'pt shop 0901 Ultimo', Phone::create('(256) 3142345678')),
            Customer::create(23, 'Filimon Embaye', Phone::create('(251) 914701723')),
            Customer::create(24, 'ABRAHAM NEGASH', Phone::create('(251) 911203317')),
            Customer::create(31, 'EMILE CHRISTIAN KOUK', Phone::create('(237) 697151594')),
            Customer::create(32, 'MICHAEL MICHAEL', Phone::create('(237) 677046616')),
            */
        ];
    }
}