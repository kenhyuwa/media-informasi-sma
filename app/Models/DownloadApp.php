<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadApp extends Model
{
    protected $table = 'download_app';
    protected $primaryKey = 'id_download';

    public function getAuthor()
    {
    	return $this->belongsTo('App\Models\User', 'author', 'id_guru');
    }

    public function getKelas()
    {
    	return $this->belongsTo('App\Models\Kelas', 'kelas_id', 'id_kelas');
    }
}
