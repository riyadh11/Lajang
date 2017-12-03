<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class foto_laporan extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'laporan', 'url_gambar',
    ];

    public function Detail_Laporan()
    {
    	return $this->belongsTo('App\detail_laporan','laporan');
    }
}
