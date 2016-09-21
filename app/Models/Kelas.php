<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas_apps';
    protected $primaryKey ='id_kelas';
    public $timestamps = false;

    public function setKelas()
    {
    	return $this->belongsTo('App\Models\KelasApp','kode_kelas','id_kelas');
    }
}
