<?php

declare(strict_types=1);

namespace PhoneNumberCategotization\Core\Domain;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="customer")
 */
class Customer
{
    private function __construct(
        /**
         * @ORM\Id
         * @ORM\Column(type="int")
         */
        private int $id,

        /** @ORM\Column(type="string") */
        private string $name,

        /** @ORM\Embedded(class="Phone", columnPrefix = false) */
        private Phone $phone
    ) { }

    public static function create(int $id, string $name, Phone $phone): self
    {
        return new self($id, $name, $phone);
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function phone(): Phone
    {
        return $this->phone;
    }
}
