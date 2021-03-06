<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laporan extends Model
{
    use SoftDeletes ;

    protected $table = 'laporans';

    protected $fillable = [
        'judul_laporan', 'pelapor', 'lat', 'long','alamat','kategori','kelurahan'
    ];

    public function Penduduk()
    {
    	return $this->belongsTo('App\Penduduk','pelapor');
    }

    public function Komentar()
    {
    	return $this->hasMany('App\Komentar','laporan');
    }

    public function Status()
    {
    	return $this->belongsTo('App\Status_Laporan','status');
    }

    public function Kategori()
    {
        return $this->belongsTo('App\Kategori','kategori');
    }

    public function Kelurahan()
    {
        return $this->belongsTo('App\Kelurahan','kelurahan');
    }

    public function PertanggungJawaban()
    {
        return $this->hasOne('App\Pertanggung_Jawaban','laporan');
    }

    public function delete()
    {

        foreach($this->Komentar->all() as $Komentar){
            $Komentar->delete();
        }

        $p=$this->PertanggungJawaban()->withTrashed()->first();
        if($p!=null){
            $p->delete();
        }
        parent::delete();
    }

}
