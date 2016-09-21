<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunApp extends Model
{
    protected $table = 'tahun_ajar_app';
    protected $primaryKey ='id_tahun';
    public $timestamps = false;

    public function getSiswa()
    {
    	return $this->belongsTo('App\Models\SiswaApp','tahun_masuk','id_tahun');
    }
    public function setTahunAjar()
    {
    	return $this->belongsTo('App\Models\KelasApp','tahun_ajaran_id','id_tahun');
    }
}
