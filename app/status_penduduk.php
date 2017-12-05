<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status_Penduduk extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'nama', 'deskripsi'
    ];

    public function Penduduk()
    {
    	return $this->hasMany('App\Penduduk','status');
    }

    public function delete()
    {
    	foreach($this->Penduduk->all() as $penduduk){
    		$penduduk->delete();
    	}
    	parent::delete();
    }

    public function restore()
    {
    	parent::restore();
    	foreach($this->Penduduk()->withTrashed()->get() as $penduduk){
    		$penduduk->restore();
    	}
    }
}
