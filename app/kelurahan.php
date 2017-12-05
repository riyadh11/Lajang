<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelurahan extends Model
{
    use SoftDeletes;

    protected $table = 'kelurahans';

    protected $fillable = [
        'nama','kecamatan','kodepos'
    ];

    public function Kecamatan()
    {
    	return $this->belongsTo('App\Kecamatan','kecamatan');
    }

    public function Laporan()
    {
    	return $this->hasMany('App\Laporan','kelurahan');
    }

        public function delete()
    {
    	foreach($this->Laporan->all() as $laporan){
    		$laporan->delete();
    	}
    	parent::delete();
    }

    public function restore()
    {
    	parent::restore();
    	foreach($this->Laporan()->withTrashed()->get() as $laporan){
    		$laporan->restore();
    	}
    }
}
