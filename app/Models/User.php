<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;
use App\Notifications\ThankForVote;
use App\Notifications\SetPasswordForVoters;
use App\Notifications\SetPasswordForUsers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'identification', 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    /**
     * Functions
     */

    public function thankForVote()
    {
        $this->notify(new ThankForVote());
    }

    public function sendPassword()
    {
        $when = now()->addMinute();
        $password = Str::random(8);
        $hashedPassword = Hash::make($password);
        if ($this->role == 'voter') {
            $this->notify((new SetPasswordForVoters($password))->delay($when));
        } else {
            $this->notify((new SetPasswordForUsers($password))->delay($when));
        }
        $this->password = $hashedPassword;
        $this->observation = "notificated";
        $this->save();
    }
}
