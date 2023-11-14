<?php
declare(strict_types=1);

class Salary
{
    public function giveRaise(object $employee, int $raiseAmount): void
    {
        $employee->salary += $raiseAmount;
        $employee->taxWithheld = $employee->salary * .20;
    }
}

