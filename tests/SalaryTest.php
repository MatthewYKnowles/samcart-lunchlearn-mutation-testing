<?php

use PHPUnit\Framework\TestCase;

class SalaryTest extends TestCase
{
    public function testOne() {
        $employee = (object) ['salary' => 50000, 'taxWithheld' => 10000];
        $salary = new Salary();
        $salary->giveRaise($employee, 2000);
        $this->assertSame(52000, $employee->salary);
    }

}