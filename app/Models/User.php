<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function getAll() {
        return self::select('users.*', 'created.name as created_by_name')
        ->join('users as created','created.id','=','users.created_by' , 'left')
        ->get();
    }

    public static function getAllDoctors() {
        $return = self::select('users.*', 'created.name as created_by_name')
        ->join('users as created','created.id','=','users.created_by' , 'left')
        ->where('users.is_doctor' , '=' , 1);

        if(!empty(Request::get('name'))){
                $return = $return->where('users.name' , 'like' ,'%'.trim(Request::get('name')).'%');
        }

        if(!empty(Request::get('email'))){
                $return = $return->where('users.email' , 'like' ,'%'.trim(Request::get('email')).'%');
        }

        if(!empty(Request::get('created_date_from'))){
                $return = $return->where('users.created_at' , '>=' , Request::get('created_date_from'));
        }

        if(!empty(Request::get('created_date_to'))){
                $return = $return->where('users.created_at' , '<=' , Request::get('created_date_to'));
        }

        $return = $return->paginate(30);

        return $return;
    }

    static public function checkIfNotDoctor($id) {
        return self::select('users.*')
        ->where('users.id' , '=' , $id)
        ->where('users.is_doctor' , '!=' , 1)
        ->get();
        
    }
}
