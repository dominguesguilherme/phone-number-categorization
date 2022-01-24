<?php

declare(strict_types=1);

namespace PhoneNumberCategotization\Core\Application;

use PhoneNumberCategotization\Core\Domain\CategorizePhoneNumbers;
use PhoneNumberCategotization\Core\Domain\Customer;
use PhoneNumberCategotization\Core\Domain\PhoneNumberCategorized;
use PhoneNumberCategotization\Core\Domain\User;
use PhoneNumberCategotization\Core\Domain\CustomerRepository;
use PhoneNumberCategotization\Framework\Id\Domain\Id;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

use function array_pop;

class FetchCategorizedPhoneNumbersHandler implements MessageHandlerInterface
{
    public function __construct(
        private CustomerRepository $repository,
        private CategorizePhoneNumbers $categorizePhoneNumbers,
    ) { }

    /** @return array<string, string> */
    public function __invoke(FetchCategorizedPhoneNumbers $command): array
    {
        $customers = $this->repository->findAll();

        $dataArrayTransformed = [];
        foreach ($customers as $key => $customer) {
            $phoneNumberCategorized = $this->categorizePhoneNumbers->categorize($customer->phone());

            $dataArrayTransformed[] = $this->phoneNumberCategorizedDataToArrayTransformer($phoneNumberCategorized);

            if (!$this->isCountryFiltered($command->countryCode, $phoneNumberCategorized->country()->code()) ||
                !$this->isStateFiltered($command->state, $phoneNumberCategorized->state())
            ) {
                array_pop($dataArrayTransformed);
            }
        }

        return $dataArrayTransformed;
    }

    private function isCountryFiltered(?string $commandCountryCode, string $phoneNumberCountryCode): bool
    {
        return $commandCountryCode === null || $commandCountryCode === $phoneNumberCountryCode;
    }

    private function isStateFiltered(?string $commandState, string $phoneNumberState): bool
    {
        return $commandState === null || $commandState === $phoneNumberState;
    }

    /**
     * @param Customer[] $customers
     * @return array<string, string>
     */
    private function phoneNumberCategorizedDataToArrayTransformer(PhoneNumberCategorized $phoneNumberCategorized): array
    {
        return [
            'country' => $phoneNumberCategorized->country()->name(),
            'state' => $phoneNumberCategorized->state(),
            'country_code' => $phoneNumberCategorized->country()->code(),
            'phone_number' => $phoneNumberCategorized->phone()->number()
        ];
    }
}
