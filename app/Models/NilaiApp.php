<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiApp extends Model
{
    protected $table = 'nilai_app';
    protected $primaryKey = 'id_nilai';
    public $timestamps = false;

    public function getSiswa()
    {
    	return $this->belongsTo('App\Models\SiswaApp', 'siswa_id');
    }

    public function getMatpel()
    {
    	return $this->belongsTo('App\Models\PelajaranApp', 'pelajaran_id');
    }

    public function getGuru()
    {
        return $this->belongsTo('App\Models\User', 'guru_id');
    }

    public function getSemester()
    {
        return $this->belongsTo('App\Models\SemesterApp', 'semester_id');
    }
}