<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Kelurahan;

class kecamatan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama',
    ];

    public function kelurahan()
    {
    	return $this->hasMany('App\kelurahan','kecamatan');
    }

    public function delete()
    {
    	foreach($this->kelurahan->all() as $kelurahan){
    		$kelurahan->delete();
    	}
    	parent::delete();
    }

    public function laporan()
    {
        $laporan=new Collection();
        foreach($this->kelurahan()->withTrashed()->get() as $kelurahan){
            foreach ($kelurahan->laporan()->withTrashed()->get() as $lapor) {
                $laporan=$laporan->push($lapor);
            }
        }
        
        return $laporan;

    }

    public function restore()
    {
    	parent::restore();
    	foreach($this->kelurahan()->withTrashed()->get() as $kelurahan){
    		$kelurahan->restore();
    	}
    }
}
