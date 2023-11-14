<?php
declare(strict_types=1);

class MovieRentalStore
{
    public function getInfo($customer)
    {
        $movies = [
            'F001' => (object) ['title' => 'Ran', 'code' => 'regular'],
            'F002' => (object) ['title' => 'Trois Couleurs: Bleu', 'code' => 'regular'],
            'F003' => (object) ['title' => 'Cars 2', 'code' => 'childrens'],
            'F004' => (object) ['title' => 'Oppenheimer', 'code' => 'new']];
        //EXERCISE NOTE: add more movies if you need
        $totalAmount = 0;
        $frequentRenterPoints = 0;
        $result = "Rental Record for $customer->name\n";

        // determine amount for each movie
        foreach ($customer->rentals as $r){
            $movie = $movies[$r->movieID];
            $thisAmount = 0;
            switch ($movie->code){
                case 'regular':
                    $thisAmount = 2;
                    if ($r->days > 2){
                        $thisAmount += ($r->days - 1) * 1.5;
                    }
                    break;
                case 'new':
                    $thisAmount = $r->days * 3;
                    break;
                case 'childrens':
                    $thisAmount = 1.5;
                    if ($r->days > 3){
                        $thisAmount += ($r->days - 2) * 1.5;
                    }
                    break;
            }
            //add frequent renter points
            $frequentRenterPoints++;
            // add bonus for a two day new release rental
            if ($movie->code === 'new' && $r->days > 2) $frequentRenterPoints++;
            //print figures for this rental
            $result .= "\t$movie->title\t$thisAmount\n";
            $totalAmount += $thisAmount;
    }
        // add footer lines
        $result .= "Amount owed is $totalAmount\n";
        $result .= "You earned $frequentRenterPoints frequent renter points\n";

        return $result;
    }
}