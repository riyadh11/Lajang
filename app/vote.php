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

    public function laporan()
    {
    	return $this->belongsTo('App\detail_laporan','laporan');
    }

    public function voter()
    {
    	return $this->belongsTo('App\Penduduk','voter');
    }
}
