<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Foto_Laporan extends Model
{
	use SoftDeletes;
	protected $table = 'foto_laporans';
	
    protected $fillable = [
        'laporan', 'url_gambar',
    ];

    public function Detail_Laporan()
    {
    	return $this->belongsTo('App\Detail_Laporan','laporan');
    }
}
