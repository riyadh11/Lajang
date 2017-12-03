<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class detail_laporan extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'laporan', 'penduduk', 'komentar',
    ];

    public function Penduduk()
    {
    	return $this->belongsTo('App\Penduduk','penduduk');
    }

    public function Laporan()
    {
    	return $this->belongsTo('App\laporan','laporan');
    }

    public function Foto_Laporan()
    {
        return $this->hasMany('App\foto_laporan','laporan');
    }

    public function Vote()
    {
        return $this->hasMany('App\vote','laporan');
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

    public function restore()
    {
        parent::restore();
        foreach($this->Foto_Laporan()->withTrashed()->get() as $foto_laporan){
            $foto_laporan->restore();
        }

        foreach($this->Vote()->withTrashed()->get() as $vote){
            $vote->restore();
        }
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
