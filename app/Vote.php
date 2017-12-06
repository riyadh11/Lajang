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

    public function Komentar()
    {
    	return $this->belongsTo('App\Komentar','laporan');
    }

    public function Voter()
    {
    	return $this->belongsTo('App\Penduduk','voter');
    }
}
