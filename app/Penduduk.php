<?php

namespace App;

use App\Notifications\PendudukResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Penduduk extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','nik','status'
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

    public function laporan()
    {
        return $this->hasMany('App\laporan','pelapor');   
    }

    public function detail_laporan()
    {
        return $this->hasMany('App\detail_laporan','penduduk');
    }

    public function vote()
    {
        return $this->hasMany('App\vote','voter');
    }

    public function administrator()
    {
        return $this->hasOne('App\Administrator','penduduk');
    }

    public function Status()
    {
        return $this->belongsTo('App\Status_penduduk','status');
    }

    public function delete()
    {
        $this->status=3;

        foreach($this->laporan->all() as $laporan){
            $laporan->delete();
        }

        foreach($this->detail_laporan->all() as $detail_laporan){
            $detail_laporan->delete();
        }

        foreach($this->vote->all() as $vote){
            $vote->delete();
        }

        if($this->administrator){
            $this->status=7;
            $this->administrator->delete();
        }

        $this->save();
        parent::delete();
    }

    public function restore()
    {
        parent::restore();
        $this->status=1;
        foreach($this->laporan()->withTrashed()->get() as $laporan){
            $laporan->restore();
        }

        foreach($this->detail_laporan()->withTrashed()->get() as $detail_laporan){
            $detail_laporan->restore();
        }

        foreach($this->vote()->withTrashed()->get() as $vote){
            $vote->restore();
        }

        if($this->administrator){
            $this->administrator->restore();
            $this->status=5;
        }
        $this->save();
    }

    public function reputation()
    {
        $plus=0;
        $negative=0;
        $reputation=0;
        foreach($this->detail_laporan->all() as $laporan){
            foreach ($laporan->vote->all() as $vote) {
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
