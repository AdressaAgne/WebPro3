<?php

namespace App\Helpers;



//Fraction Conversion
class Fractions {
    public static function numberWithDecimals_to_string($decimalNumber){

        // Round to quarter above
        $x = $decimalNumber * 4;
        $y = ceil($x);
        $roundedToQuarter = $y / 4;

        // Split number and fraction
        $wholeNumber = floor($roundedToQuarter);
        $onlyDecimals = $roundedToQuarter - $wholeNumber;

        // Make fraction into string
        switch ($onlyDecimals) {
            case '0.25':
                $fraction = "¼";
                break;

            case '0.50':
                $fraction = "½";
                break;

            case '0.75':
                $fraction = "¾";
                break;

            default:
                $fraction = "";
                break;
        }

        // Return whole number and fraction
        if ($wholeNumber == 0) {
          return $fraction;

        } else {
          return $wholeNumber . " " . $fraction;
        }
    }
}
