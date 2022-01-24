<?php

declare(strict_types=1);

namespace PhoneNumberCategotization\Tests\Core\Infrastructure\Persistence;

use PhoneNumberCategotization\Core\Domain\Phone;
use PhoneNumberCategotization\Core\Infrastructure\Persistence\InMemoryCustomerRepository;
use PHPUnit\Framework\TestCase;
use PhoneNumberCategotization\Core\Domain\Customer;

class InMemoryCustomerRepositoryTest extends TestCase
{
    public function test_find_all_customers(): void
    {
        $expextedCustomers = $this->customers();
        $repository = new InMemoryCustomerRepository($expextedCustomers);

        $customersFound = $repository->findAll();

        $this->assertEquals($expextedCustomers, $customersFound);
    }

    /** @return Customer[] */
    private function customers(): array
    {
        return [
            Customer::create(0 , 'Walid Hammadi', Phone::create('(212) 6007989253')),
            Customer::create(1 , 'Yosaf Karrouch', Phone::create('(212) 698054317')),
            Customer::create(2 , 'Younes Boutikyad' , Phone::create('(212) 6546545369')),
            Customer::create(3 , 'Houda Houda', Phone::create('(212) 6617344445')),
            Customer::create(4 , 'Chouf Malo', Phone::create('(212) 691933626')),
            Customer::create(5 , 'soufiane fritisse', Phone::create('(212) 633963130')),
            Customer::create(6 , 'Nada Sofie', Phone::create('(212) 654642448')),
            Customer::create(7 , 'Edunildo Gomes', Phone::create('(258) 847651504')),
            Customer::create(8 , 'Wallas Singz Junior', Phone::create('(258) 846565883')),
            Customer::create(9 , 'sevilton sylvestre', Phone::create('(258) 849181828')),
            Customer::create(10, 'Tanvi Sachdeva', Phone::create('(258) 84330678235')),
            Customer::create(11, 'Florencio Samuel', Phone::create('(258) 847602609')),
            Customer::create(12, 'Solo Dolo', Phone::create('(258) 042423566')),
            Customer::create(13, 'Pedro B', Phone::create('(258) 823747618')),
            Customer::create(14, 'Ezequiel Fenias', Phone::create('(258) 848826725')),
            Customer::create(15, 'JACKSON NELLY', Phone::create('(256) 775069443')),
            Customer::create(16, 'Kiwanuka Budallah', Phone::create('(256) 7503O6263')),
            Customer::create(17, 'VINEET SETH', Phone::create('(256) 704244430')),
            Customer::create(18, 'Jokkene Richard', Phone::create('(256) 7734127498')),
            Customer::create(19, 'Ogwal David', Phone::create('(256) 7771031454')),
            Customer::create(20, 'pt shop 0901 Ultimo', Phone::create('(256) 3142345678')),
            Customer::create(21, 'Daniel Makori', Phone::create('(256) 714660221')),
            Customer::create(22, 'shop23 sales' , Phone::create('(251) 9773199405')),
            Customer::create(23, 'Filimon Embaye', Phone::create('(251) 914701723')),
            Customer::create(24, 'ABRAHAM NEGASH', Phone::create('(251) 911203317')),
            Customer::create(25, 'ZEKARIAS KEBEDE', Phone::create('(251) 9119454961')),
            Customer::create(26, 'EPHREM KINFE' , Phone::create('(251) 914148181')),
            Customer::create(27, 'Karim Niki', Phone::create('(251) 966002259')),
            Customer::create(28, 'Frehiwot Teka', Phone::create('(251) 988200000')),
            Customer::create(29, 'Fanetahune Abaia' , Phone::create('(251) 924418461')),
            Customer::create(30, 'Yonatan Tekelay', Phone::create('(251) 911168450')),
            Customer::create(31, 'EMILE CHRISTIAN KOUK', Phone::create('(237) 697151594')),
            Customer::create(32, 'MICHAEL MICHAEL', Phone::create('(237) 677046616')),
            Customer::create(33, 'ARREYMANYOR ROLAND', Phone::create('(237) 6A0311634')),
            Customer::create(34, 'LOUIS PARFAIT OMBES', Phone::create('(237) 673122155')),
            Customer::create(35, 'JOSEPH FELICIEN', Phone::create('(237) 695539786')),
            Customer::create(36, 'SUGAR STARRK', Phone::create('(237) 6780009592')),
            Customer::create(37, 'WILLIAM KEMFANG', Phone::create('(237) 6622284920')),
            Customer::create(38, 'THOMAS WILFRIED', Phone::create('(237) 696443597')),
            Customer::create(39, 'Dominique mekontchou', Phone::create('(237) 691816558')),
            Customer::create(40, 'Nelson Nelson', Phone::create('(237) 699209115')),
        ];
    }
}