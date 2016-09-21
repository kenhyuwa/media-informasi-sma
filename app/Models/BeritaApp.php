<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeritaApp extends Model
{
	protected $table = 'berita_app';
	protected $primaryKey = 'id_berita';
	
	public function getAdmin()
	{
	return $this->belongsTo('App\Models\User', 'author');
	}
}
