<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    protected $table = 'role';

    static public function getRecord() {
        return self::get();
    }

    static public function getSingle($id) {
        return self::find($id);
    }
    
}
