<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengumumanApp extends Model
{
	protected $table = 'pengumuman_app';
	protected $primaryKey = 'id_pengumuman';
	
	public function getAdmin()
	{
	return $this->belongsTo('App\Models\User', 'author');
	}
}
