<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class SiswaApp extends Authenticatable
{
    protected $table ='siswa_app';
    protected $primaryKey ='id_siswa';
    public $timestamps = false;
    protected $fillable =[
        'nis', 'nama', 'tempat_lahir', 'tgl_lahir', 'alamat', 'no_telp', 'gender', 'agama', 'sekolah_asal', 'tahun_masuk', 'status', 'anak_ke', 'jumlah_sdr', 'nama_ayah', 'pdd_akhir_ayah', 'pekerjaan_ayah', 'agama_ayah', 'nama_ibu', 'pdd_akhir_ibu', 'pekerjaan_ibu', 'agama_ibu', 'nama_ortu_wali', 'alamat_ortu_wali'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $guarded = '*';

    public function getTahun()
    {
        return $this->belongsTo('App\Models\TahunApp', 'tahun_masuk');
    }

    public function setSiswa()
    {
        return $this->hasOne('App\Models\KelasSiswaApp', 'siswa_id','id_siswa');
    }

    public function setSiswaNilai()
    {
        return $this->hasOne('App\Models\NilaiApp', 'siswa_id','id_siswa');
    }
}
