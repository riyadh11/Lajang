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

    public function penduduk()
    {
    	return $this->belongsTo('App\Penduduk','penduduk');
    }

    public function laporan()
    {
    	return $this->belongsTo('App\laporan','laporan');
    }

    public function foto_laporan()
    {
        return $this->hasMany('App\foto_laporan','laporan');
    }

    public function vote()
    {
        return $this->hasMany('App\vote','laporan');
    }

    public function delete()
    {
        foreach($this->foto_laporan->all() as $foto_laporan){
            $foto_laporan->delete();
        }

        foreach($this->vote->all() as $vote){
            $vote->delete();
        }
        parent::delete();
    }

    public function restore()
    {
        parent::restore();
        foreach($this->foto_laporan()->withTrashed()->get() as $foto_laporan){
            $foto_laporan->restore();
        }

        foreach($this->vote()->withTrashed()->get() as $vote){
            $vote->restore();
        }
    }

    public function reputation()
    {
        $plus=0;
        $negative=0;
        $reputation=0;
        foreach ($this->vote->all() as $vote) {
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
