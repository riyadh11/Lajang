<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Biaya_Perbaikan extends Model
{
    use SoftDeletes;
    protected $table = 'biaya_perbaikans';
	
    protected $fillable = [
        'nama','deskripsi','unit','harga','laporan'
    ];

    public function Laporan()
    {
    	return $this->belongsTo('App\Pertanggung_Jawaban','laporan');
    }
}
