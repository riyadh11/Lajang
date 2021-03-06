<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Komentar extends Model
{
    use SoftDeletes;
    protected $table = 'komentars';
    
    protected $fillable = [
        'laporan', 'penduduk', 'komentar',
    ];

    public function Penduduk()
    {
    	return $this->belongsTo('App\Penduduk','penduduk');
    }

    public function Laporan()
    {
    	return $this->belongsTo('App\Laporan','laporan');
    }

    public function Foto_Laporan()
    {
        return $this->hasMany('App\Foto_Laporan','laporan');
    }

    public function Vote()
    {
        return $this->hasMany('App\Vote','laporan');
    }

    public function delete()
    {
        foreach($this->Foto_Laporan->all() as $foto_laporan){
            $foto_laporan->delete();
        }

        foreach($this->Vote->all() as $vote){
            $vote->delete();
        }
        parent::delete();
    }

    public function Reputation()
    {
        $plus=0;
        $negative=0;
        $reputation=0;
        foreach ($this->Vote->all() as $vote) {
            if($vote->like){
                $plus++;
            }else{
                $negative++;
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
