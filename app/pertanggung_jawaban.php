<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pertanggung_Jawaban extends Model
{
    use SoftDeletes;

    protected $table = 'pertanggung_jawabans';
	
    protected $fillable = [
        'laporan','keterangan', 'kendala', 'solusi', 'administrator',
    ];

    public function Administrator()
    {
    	return $this->belongsTo('App\Administrator','administrator');
    }

    public function Laporan()
    {
    	return $this->belongsTo('App\laporan','laporan');
    }

    public function Biaya()
    {
    	return $this->hasMany('App\Biaya_Perbaikan','laporan');
    }

    public function delete()
    {
        foreach($this->Biaya()->withTrashed()->get() as $Biaya){
            $Biaya->delete();
        }
        parent::delete();
    }

    public function restore()
    {
        parent::restore();
        foreach($this->Biaya()->withTrashed()->get() as $Biaya){
            $Biaya->restore();
        }
    }

}
