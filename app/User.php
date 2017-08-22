<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function login($payload)
    {
        $data = $this->where('username',$payload['username'])->get();
        if(count($data) == 0)
        {
            return false;
        }
        else
        {
            $cek2 = Hash::check($payload['password'], $data[0]->password);
            if($cek2)
            {
                return $data[0];
            }
            else
            {
                return false;
            }
        }
    }
}
