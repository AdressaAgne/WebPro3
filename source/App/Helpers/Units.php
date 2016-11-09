<?php

namespace App\Helpers;



// Unit Convertion
class Units {

    // Liquid units
    public static function dl_to_floz($ConvertValue){

        return (round($ConvertValue * 3.38140227, 2));
    }

    public static function floz_to_dl($ConvertValue){

        return (round($ConvertValue * 0.295735296, 2));
    }

    public static function l_to_floz($ConvertValue){

        return (round($ConvertValue * 33.8140227, 2));
    }

    public static function floz_to_l($ConvertValue){

        return (round($ConvertValue * 0.0295735296, 2));
    }

    public static function l_to_uspint($ConvertValue){

        return (round($ConvertValue * 2.11337642, 2));
    }

    public static function uspint_to_l($ConvertValue){

        return (round($ConvertValue * 0.473176473, 2));
    }

    public static function l_to_imppint($ConvertValue){

        return (round($ConvertValue * 1.75975326, 2));
    }

    public static function imppint_to_l($ConvertValue){

        return (round($ConvertValue * 0.568261485, 2));
    }

    public static function dl_to_uspint($ConvertValue){

        return (round($ConvertValue * 0.211337642, 2));
    }

    public static function uspint_to_dl($ConvertValue){

        return (round($ConvertValue * 4.73176473, 2));
    }

    public static function dl_to_imppint($ConvertValue){
 
        return (round($ConvertValue * 0.175975326, 2));
    }
 
    public static function imppint_to_dl($ConvertValue){
 
        return (round($ConvertValue * 5.68261485, 2));
    }


    // Weight units
    public static function kg_to_lb($ConvertValue){

        return (round($ConvertValue * 2.20462262, 2));
    }

    public static function lb_to_kg($ConvertValue){

        return (round($ConvertValue * 0.45359237, 2));
    }

    public static function kg_to_oz($ConvertValue){

        return (round($ConvertValue * 35.2739619, 2));
    }

    public static function oz_to_kg($ConvertValue){

        return (round($ConvertValue * 0.0283495231, 2));
    }

    public static function g_to_oz($ConvertValue){

        return (round($ConvertValue * 0.0352739619, 2));
    }

    public static function oz_to_g($ConvertValue){

        return (round($ConvertValue * 28.3495231, 2));
    }

    public static function g_to_lb($ConvertValue){

        return (round($ConvertValue * 0.00220462262, 2));
    }

    public static function lb_to_g($ConvertValue){

        return (round($ConvertValue * 453.59237, 2));
    }
}
