<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class status_penduduk extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'nama', 'deskripsi'
    ];

    public function penduduk()
    {
    	return $this->hasMany('App\penduduk','status');
    }

    public function delete()
    {
    	foreach($this->penduduk->all() as $penduduk){
    		$penduduk->delete();
    	}
    	parent::delete();
    }

    public function restore()
    {
    	parent::restore();
    	foreach($this->penduduk()->withTrashed()->get() as $penduduk){
    		$penduduk->restore();
    	}
    }
}
