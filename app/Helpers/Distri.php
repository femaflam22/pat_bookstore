<?php
namespace App\Helpers;

use App\Models\Distributor;


class Distri
{
    public static function IDGenerator($model, $trow, $length = 4, $prefix)
    {
        $data = $model::orderBy('id','desc')->first();
        if(!$data){
            $og_length = $length;
            $last_number = "";
        }else{
            $code = substr($data->$trow, strlen($prefix)+1);
            $actial_last_number = ($code/1)*1;
            $increment_last_number = $actial_last_number;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $distributors = Distributor::all();
            $last_number = count($distributors);
        }
        $zeros = "";
        for($i=0; $i<$og_length; $i++){
            $zeros.="0";
        }
        return $prefix.'-'.$zeros.$last_number;
    }
}
?>