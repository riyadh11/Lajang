<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class vote extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'laporan', 'voter', 'like',
    ];

    public function Laporan()
    {
    	return $this->belongsTo('App\detail_laporan','laporan');
    }

    public function Voter()
    {
    	return $this->belongsTo('App\Penduduk','voter');
    }
}
