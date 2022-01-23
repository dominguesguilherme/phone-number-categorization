<?php

declare(strict_types=1);

namespace PhoneNumberCategotization\Core\Domain;

class PhoneNumberCategorized
{
    private function __construct(
        private Country $country,
        private Phone $phone,
        private string $state,
    ) { }

    public static function createPhoneNumberOk(Country $country, Phone $phone): self
    {
        return new self($country, $phone, 'OK');
    }

    public static function createPhoneNumberNOk(Country $country, Phone $phone): self
    {
        return new self($country, $phone, 'NOK');
    }

    public function country(): Country
    {
        return $this->country;
    }

    public function phone(): Phone
    {
        return $this->phone;
    }

    public function state(): string
    {
        return $this->state;
    }
}