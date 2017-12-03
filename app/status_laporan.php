<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class status_laporan extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'nama', 'deskripsi', 'icon',
    ];

    public function Laporan()
    {
    	return $this->hasMany('App\laporan','status');
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
