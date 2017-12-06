<?php

namespace App;

use App\Notifications\PendudukResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Penduduk extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $table = 'penduduks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','nik','status','activation_token'
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
        $this->notify(new PendudukResetPassword($token));
    }

    public function Laporan()
    {
        return $this->hasMany('App\Laporan','pelapor');   
    }

    public function Komentar()
    {
        return $this->hasMany('App\Komentar','penduduk');
    }

    public function Vote()
    {
        return $this->hasMany('App\Vote','voter');
    }

    public function Administrator()
    {
        return $this->hasOne('App\Administrator','penduduk');
    }

    public function Status()
    {
        return $this->belongsTo('App\Status_Penduduk','status');
    }

    public function delete()
    {
        $this->status=3;

        foreach($this->Laporan->all() as $laporan){
            $laporan->delete();
        }

        foreach($this->Komentar->all() as $Komentar){
            $Komentar->delete();
        }

        foreach($this->Vote->all() as $vote){
            $vote->delete();
        }

        if($this->Administrator){
            $this->status=7;
            $admin=$this->Administrator;
            $admin->delete();
        }

        $this->save();
        parent::delete();
    }

    public function Reputation()
    {
        $plus=0;
        $negative=0;
        $reputation=0;
        foreach($this->Komentar->all() as $laporan){
            foreach ($laporan->Vote->all() as $vote) {
                if($vote->like){
                    $plus++;
                }else{
                    $negative++;
                }
            }
        }
        if($plus+$negative==0){
            $reputation=0;
        }else{
            $reputation=($plus)/($plus+$negative);
        }
        return $reputation*100;
    }
}
