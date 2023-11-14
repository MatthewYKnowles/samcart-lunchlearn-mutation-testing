<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;


class MovieRentalStoreTest extends TestCase {
    private $classUnderTest;
    protected function setUp(): void
    {
        $this->classUnderTest = new MovieRentalStore();
    }

    public function testOne(): void {
        $properResult =
            "Rental Record for martin\n" .
                "\tRan\t5\n" .
                "\tTrois Couleurs: Bleu\t2\n" .
            "Amount owed is 7\n" .
            "You earned 2 frequent renter points\n";
        $customer = (object)[
            'name' => 'martin',
            'rentals' => [(object)['movieID'=> 'F001', 'days' => 3 ], (object)[ 'movieID' => 'F002', 'days' => 1 ]]
    ];
        $actualResult = $this->classUnderTest->getInfo($customer);
        static::assertSame($properResult, $actualResult);
    }

    public function testTwo(): void {
        $properResult =
            "Rental Record for martin\n" .
            "\tCars 2\t4.5\n" .
            "\tOppenheimer\t6\n" .
            "Amount owed is 10.5\n" .
            "You earned 2 frequent renter points\n";
        $customer = (object)[
            'name' => 'martin',
            'rentals' => [(object)['movieID'=> 'F003', 'days' => 4 ], (object)[ 'movieID' => 'F004', 'days' => 2 ]]
        ];
        $actualResult = $this->classUnderTest->getInfo($customer);
        static::assertSame($properResult, $actualResult);
    }

    public function testThree(): void {
        $properResult =
            "Rental Record for martin\n" .
            "\tCars 2\t1.5\n" .
            "\tRan\t2\n" .
            "\tOppenheimer\t9\n" .
            "Amount owed is 12.5\n" .
            "You earned 4 frequent renter points\n";
        $customer = (object)[
            'name' => 'martin',
            'rentals' => [(object)['movieID'=> 'F003', 'days' => 3 ], (object)[ 'movieID' => 'F001', 'days' => 2 ], (object)[ 'movieID' => 'F004', 'days' => 3 ]]
        ];
        $actualResult = $this->classUnderTest->getInfo($customer);
        static::assertSame($properResult, $actualResult);
    }
}