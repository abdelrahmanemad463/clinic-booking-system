<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
class Clinics extends Model
{
    protected $table = 'clinics';

   public static function getAll() {
        $return = self::select('clinics.*' , 'users.name as created_by_name')
                ->join('users','users.id','=','clinics.created_by' , 'left');

        if(!empty(Request::get('name'))){
                $return = $return->where('clinics.name' , 'like' ,'%'.trim(Request::get('name')).'%');
        }

        if(!empty(Request::get('created_date_from'))){
                $return = $return->where('clinics.created_at' , '>=' , Request::get('created_date_from'));
        }

        if(!empty(Request::get('created_date_to'))){
                $return = $return->where('clinics.created_at' , '<=' , Request::get('created_date_to'));
        }

         $return = $return->paginate(20);

        return $return;
    }

   public static function getAllStatusActive() {
        return self::select('clinics.*')
                        ->where('status' , '=' , 1)
                        ->get();
    }
}
