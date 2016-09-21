<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KelasApp extends Model
{
    protected $table ='kelas_app';
    public $timestamps = false;
    protected $primaryKey = 'id';

    public function getWaliKelas()
    {
    	return $this->belongsTo('App\Models\User', 'guru_id');
    }
    public function getKelas()
    {
    	return $this->belongsTo('App\Models\Kelas', 'kode_kelas');
    }
    public function getSemester()
    {
    	return $this->belongsTo('App\Models\SemesterApp', 'semester_id');
    }
    public function getTahunAjar()
    {
    	return $this->belongsTo('App\Models\TahunApp', 'tahun_ajaran_id');
    }
}
