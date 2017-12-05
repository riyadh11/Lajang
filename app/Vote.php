<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Vote extends Model
{
    use SoftDeletes;

    protected $table = 'votes';
    
    protected $fillable = [
        'laporan', 'voter', 'like',
    ];

    public function Laporan()
    {
    	return $this->belongsTo('App\Detail_Laporan','laporan');
    }

    public function Voter()
    {
    	return $this->belongsTo('App\Penduduk','voter');
    }
}
