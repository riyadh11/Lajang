<?php

namespace App;

use App\Notifications\AdministratorResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrator extends Authenticatable
{
    use Notifiable,SoftDeletes;
    protected $table = 'administrators';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','penduduk',
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
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdministratorResetPassword($token));
    }

    public function Penduduk()
    {
        return $this->belongsTo('App\Penduduk','penduduk');
    }

    public function PertanggungJawaban()
    {
        return $this->hasMany('App\Pertanggung_Jawaban','administrator');
    }

    public function delete()
    {
        foreach($this->PertanggungJawaban->all() as $laporan){
            $laporan->delete();
        }
        parent::delete();
    }

    public function restore()
    {
        parent::restore();
        foreach($this->PertanggungJawaban()->withTrashed()->get() as $laporan){
            $laporan->restore();
        }
    }
}
