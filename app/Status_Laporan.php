<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status_Laporan extends Model
{
	use SoftDeletes;

    protected $table = 'status_laporans';
	
    protected $fillable = [
        'nama', 'deskripsi', 'icon',
    ];

    public function Laporan()
    {
    	return $this->hasMany('App\Laporan','status');
    }

    public function delete()
    {
    	foreach($this->Laporan->all() as $laporan){
    		$laporan->delete();
    	}
    	parent::delete();
    }
}
