<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelasSiswaApp extends Model
{
    protected $table = 'kelas_siswa';
    //protected $primaryKey ='siswa_id';
    protected $primaryKey = 'kode_kelas';
    public $timestamps = false;
    public $incrementing = false;

    public function getSiswa()
    {
    	return $this->belongsTo('App\Models\SiswaApp','siswa_id');
    }
}
