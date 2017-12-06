<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
	use SoftDeletes;
    protected $table = 'kategoris';

    protected $fillable = [
        'nama', 'deskripsi',
    ];

    public function Laporan()
    {
    	return $this->hasMany('App\Laporan','kategori');
    }

    public function delete()
    {
    	foreach($this->Laporan->all() as $laporan){
    		$laporan->delete();
    	}
    	parent::delete();
    }
}
