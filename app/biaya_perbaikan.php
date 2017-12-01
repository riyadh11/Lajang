<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class biaya_perbaikan extends Model
{
    use SoftDeletes;
	
    protected $fillable = [
        'nama','deskripsi','unit','harga','laporan'
    ];

    public function Laporan()
    {
    	return $this->belongsTo('App\pertanggung_jawaban','laporan');
    }
}
