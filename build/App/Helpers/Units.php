<?php

namespace App\Helpers;



// Unit Convertion
class Units {

    // Liquid units
    public static function dl_to_floz($ConvertValue){

    return $ConvertValue * 3.38140227;
    }

    public static function floz_to_dl($ConvertValue){

    return $ConvertValue * 0.295735296;
    }

    public static function l_to_floz($ConvertValue){

    return $ConvertValue * 33.8140227;
    }

    public static function floz_to_l($ConvertValue){

    return $ConvertValue * 0.0295735296;
    }

    public static function l_to_uspint($ConvertValue){

    return $ConvertValue * 2.11337642;
    }

    public static function uspint_to_l($ConvertValue){

    return $ConvertValue * 0.473176473;
    }

    public static function l_to_imppint($ConvertValue){

    return $ConvertValue * 1.75975326;
    }

    public static function imppint_to_l($ConvertValue){

    return $ConvertValue * 0.568261485;
    }

    public static function dl_to_uspint($ConvertValue){

    return $ConvertValue * 0.211337642;
    }

    public static function uspint_to_dl($ConvertValue){

    return $ConvertValue * 4.73176473;
    }

    public static function l_to_imppint($ConvertValue){

    return $ConvertValue * 0.175975326;
    }

    public static function imppint_to_l($ConvertValue){

    return $ConvertValue * 5.68261485;
    }


    // Weight units
    public static function kg_to_lb($ConvertValue){

    return $ConvertValue * 2.20462262;
    }

    public static function lb_to_kg($ConvertValue){

    return $ConvertValue * 0.45359237;
    }

    public static function kg_to_oz($ConvertValue){

    return $ConvertValue * 35.2739619;
    }

    public static function oz_to_kg($ConvertValue){

    return $ConvertValue * 0.0283495231;
    }

    public static function g_to_oz($ConvertValue){

    return $ConvertValue * 0.0352739619;
    }

    public static function oz_to_g($ConvertValue){

    return $ConvertValue * 28.3495231;
    }

    public static function g_to_lb($ConvertValue){

    return $ConvertValue * 0.00220462262;
    }

    public static function lb_to_g($ConvertValue){

    return $ConvertValue * 453.59237;
    }
}
