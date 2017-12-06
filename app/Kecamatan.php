<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Kelurahan;

class Kecamatan extends Model
{
    use SoftDeletes;

    protected $table = 'kecamatans';

    protected $fillable = [
        'nama',
    ];

    public function Kelurahan()
    {
    	return $this->hasMany('App\Kelurahan','kecamatan');
    }

    public function delete()
    {
    	foreach($this->Kelurahan->all() as $kelurahan){
    		$kelurahan->delete();
    	}
    	parent::delete();
    }

    public function Laporan()
    {
        $laporan=new Collection();
        foreach($this->Kelurahan->all() as $kelurahan){
            foreach ($kelurahan->Laporan->all() as $lapor) {
                $laporan=$laporan->push($lapor);
            }
        }
        
        return $laporan;

    }

    public function restore()
    {
    	parent::restore();
    	foreach($this->Kelurahan()->withTrashed()->get() as $kelurahan){
    		$kelurahan->restore();
    	}
    }
}
