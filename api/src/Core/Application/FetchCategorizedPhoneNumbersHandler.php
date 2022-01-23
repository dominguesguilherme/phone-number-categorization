<?php

declare(strict_types=1);

namespace PhoneNumberCategotization\Core\Application;

use PhoneNumberCategotization\Core\Domain\Customer;
use PhoneNumberCategotization\Core\Domain\User;
use PhoneNumberCategotization\Core\Domain\CustomerRepository;
use PhoneNumberCategotization\Framework\Id\Domain\Id;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class FetchCategorizedPhoneNumbersHandler implements MessageHandlerInterface
{
    private CustomerRepository $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    /** @return array<string, string> */
    public function __invoke(FetchCategorizedPhoneNumbers $command): array
    {
        $customers = $this->repository->findWithPagination();

        return $this->userDataToArrayTransformer($customers);
    }

    /**
     * @param Customer[] $customers
     * @return array<string, string>
     */
    private function userDataToArrayTransformer(array $customers): array
    {
        $categorizedPhoneNumbers = [];
        foreach ($customers as $customer) {
            $categorizedPhoneNumbers[] = [
                'country' => '',
                'state' => '',
                'country_code' => '',
                'phone_number' => ''
            ];
        }

        return $categorizedPhoneNumbers;
    }
}
