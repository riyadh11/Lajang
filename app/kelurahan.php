<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class kelurahan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama','kecamatan','kodepos'
    ];

    public function Kecamatan()
    {
    	return $this->belongsTo('App\kecamatan','kecamatan');
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
