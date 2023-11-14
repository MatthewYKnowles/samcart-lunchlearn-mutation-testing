<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class SalaryTest extends TestCase
{
    public function testOne() {
        $employee = (object) ['salary' => 50000, 'taxWithheld' => 10000];
        $salary = new Salary();
        $salary->giveRaise($employee, 2000);
        static::assertSame(52000, $employee->salary);
    }

}