<?php

declare(strict_types=1);

namespace PhoneNumberCategotization\Core\Domain;

use function preg_match;
use function str_contains;
use function sprintf;

class CategorizePhoneNumbers
{
    public function __construct(
        private CountryFinder $countryRepository,
    ) { }

    public function categorize(Phone $phone): PhoneNumberCategorized
    {
        $country = $this->findCountryByPhoneNumber($phone);
        $isPhoneNumberValid = $this->isPhoneNumberValid($country, $phone);

        return $isPhoneNumberValid
            ? PhoneNumberCategorized::createPhoneNumberOk($country, $phone)
            : PhoneNumberCategorized::createPhoneNumberNOk($country, $phone);
    }

    private function findCountryByPhoneNumber(Phone $phone): ?Country
    {
        $countries = $this->countryRepository->findAll();

        foreach ($countries as $country) {
            $isSameCountryCode = str_contains($phone->number(), sprintf('(%s)', $country->code())) === true;
            if (! $isSameCountryCode){
                continue;
            }

            return $country;
        }

        return null;
    }

    private function isPhoneNumberValid(Country $country, Phone $phone): bool
    {
        return preg_match($country->regexValidation(), $phone->number()) == true;
    }
}
