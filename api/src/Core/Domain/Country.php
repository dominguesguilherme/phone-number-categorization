<?php

declare(strict_types=1);

namespace PhoneNumberCategotization\Core\Domain;

class Country
{
    private function __construct(
        private string $name,
        private string $code,
        private string $regexValidation,
    ) { }

    public static function create(string $name, string $code, string $regexValidation): self
    {
        return new self($name, $code, $regexValidation);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function regexValidation(): string
    {
        return $this->regexValidation;
    }
}
