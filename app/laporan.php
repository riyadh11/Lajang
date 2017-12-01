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

    public function penduduk()
    {
    	return $this->belongsTo('App\Penduduk','pelapor');
    }

    public function detail_laporan()
    {
    	return $this->hasMany('App\detail_laporan','laporan');
    }

    public function status()
    {
    	return $this->belongsTo('App\status_laporan','status');
    }

    public function Kategori()
    {
        return $this->belongsTo('App\kategori','kategori');
    }

    public function kelurahan()
    {
        return $this->belongsTo('App\kelurahan','kelurahan');
    }

    public function pertanggungJawaban()
    {
        return $this->hasOne('App\pertanggung_jawaban','laporan');
    }

    public function delete()
    {

        foreach($this->detail_laporan->all() as $detail_laporan){
            $detail_laporan->delete();
        }

        $p=$this->pertanggungJawaban()->withTrashed()->first();
        $p->delete();
        parent::delete();
    }

    public function restore()
    {
        parent::restore();
        foreach($this->detail_laporan()->withTrashed()->get() as $detail_laporan){
            $detail_laporan->restore();
        }

        $p=$this->pertanggungJawaban()->withTrashed()->first();
        $p->restore();
    }

}
