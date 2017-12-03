<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class laporan extends Model
{
    use SoftDeletes ;
    
    protected $fillable = [
        'judul_laporan', 'pelapor', 'lat', 'long','alamat','kategori','kelurahan'
    ];

    public function Penduduk()
    {
    	return $this->belongsTo('App\Penduduk','pelapor');
    }

    public function Detail_Laporan()
    {
    	return $this->hasMany('App\detail_laporan','laporan');
    }

    public function Status()
    {
    	return $this->belongsTo('App\status_laporan','status');
    }

    public function Kategori()
    {
        return $this->belongsTo('App\kategori','kategori');
    }

    public function Kelurahan()
    {
        return $this->belongsTo('App\kelurahan','kelurahan');
    }

    public function PertanggungJawaban()
    {
        return $this->hasOne('App\pertanggung_jawaban','laporan');
    }

    public function delete()
    {

        foreach($this->Detail_Laporan->all() as $detail_laporan){
            $detail_laporan->delete();
        }

        $p=$this->PertanggungJawaban()->withTrashed()->first();
        $p->delete();
        parent::delete();
    }

    public function restore()
    {
        parent::restore();
        foreach($this->Detail_Laporan()->withTrashed()->get() as $detail_laporan){
            $detail_laporan->restore();
        }

        $p=$this->PertanggungJawaban()->withTrashed()->first();
        $p->restore();
    }

}
