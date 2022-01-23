<?php

declare(strict_types=1);

namespace PhoneNumberCategotization\Tests\Core\Domain;

use PhoneNumberCategotization\Core\Domain\CategorizePhoneNumbers;
use PhoneNumberCategotization\Core\Domain\Country;
use PhoneNumberCategotization\Core\Domain\Phone;
use PhoneNumberCategotization\Core\Domain\PhoneNumberCategorized;
use PhoneNumberCategotization\Core\Infrastructure\FixedCountryFinder;
use PHPUnit\Framework\TestCase;

class CategorizePhoneNumbersTest extends TestCase
{
    /** @dataProvider providedScenarios */
    public function test_should_categorize_phone_number(
        Phone $phone,
        string $expectedState,
        string $expectedCountryName,
        string $expectedCountryCode
    ): void
    {
        $categorizePhoneNumbers = new CategorizePhoneNumbers(new FixedCountryFinder());

        $phoneNumberCategorized = $categorizePhoneNumbers->categorize($phone);

        $this->assertEquals($expectedState, $phoneNumberCategorized->state());
        $this->assertEquals($expectedCountryName, $phoneNumberCategorized->country()->name());
        $this->assertEquals($expectedCountryCode, $phoneNumberCategorized->country()->code());
    }

    public function providedScenarios(): array
    {
        return [
            'for Marroco with state OK' => [
                'phone' => Phone::create('(212) 698054317'),
                'expectedState' => 'OK',
                'expectedCountryName' => 'Morocco',
                'expectedCountryCode' => '212',
            ],
            'for Mozambique with state OK' => [
                'phone' => Phone::create('(258) 849181828'),
                'expectedState' => 'OK',
                'expectedCountryName' => 'Mozambique',
                'expectedCountryCode' => '258',
            ],
            'for Mozambique with state NOK' => [
                'phone' => Phone::create('(258) 84330678235'),
                'expectedState' => 'NOK',
                'expectedCountryName' => 'Mozambique',
                'expectedCountryCode' => '258',
            ],
            'for Uganda with state NOK' => [
                'phone' => Phone::create('(256) 7771031454'),
                'expectedState' => 'NOK',
                'expectedCountryName' => 'Uganda',
                'expectedCountryCode' => '256',
            ],
            'for Uganda with state OK' => [
                'phone' => Phone::create('(256) 775069443'),
                'expectedState' => 'OK',
                'expectedCountryName' => 'Uganda',
                'expectedCountryCode' => '256',
            ],
            'for Ethiopia with state OK' => [
                'phone' => Phone::create('(251) 914701723'),
                'expectedState' => 'OK',
                'expectedCountryName' => 'Ethiopia',
                'expectedCountryCode' => '251',
            ],
            'for Ethiopia with state NOK' => [
                'phone' => Phone::create('(251) 9773199405'),
                'expectedState' => 'NOK',
                'expectedCountryName' => 'Ethiopia',
                'expectedCountryCode' => '251',
            ],
            'for Cameroon with state OK' => [
                'phone' => Phone::create('(237) 697151594'),
                'expectedState' => 'OK',
                'expectedCountryName' => 'Cameroon',
                'expectedCountryCode' => '237',
            ],
            'for Cameroon with state NOK' => [
                'phone' => Phone::create('(237) 6622284920'),
                'expectedState' => 'NOK',
                'expectedCountryName' => 'Cameroon',
                'expectedCountryCode' => '237',
            ],
        ];
    }
}