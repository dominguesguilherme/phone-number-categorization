<?php

declare(strict_types=1);

namespace PhoneNumberCategotization\Core\Domain;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Phone
{
    private function __construct(
        /** @ORM\Column(type="string", name="phone") */
        private string $number,
    ) { }

    public static function create(string $number): self
    {
        return new self($number);
    }

    public function number(): string
    {
        return $this->number;
    }
}
