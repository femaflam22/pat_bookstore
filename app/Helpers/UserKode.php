<?php
namespace App\Helpers;

use App\Models\User;

class UserKode
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
            $user = User::all();
            $last_number = count($user);
        }
        $zeros = "";
        for($i=0; $i<$og_length; $i++){
            $zeros.="0";
        }
        return $prefix.'-'.$zeros.$last_number;
    }
}
?>