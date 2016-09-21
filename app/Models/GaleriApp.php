<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriApp extends Model
{
	protected $table = 'galeri_app';
	protected $primaryKey = 'id_foto';
	public $timestamps =false;
	
	public function getAlbum()
	{
	return $this->belongsTo('App\Models\AlbumApp', 'album_id');
	}
}
