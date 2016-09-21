<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendaApp extends Model
{
	protected $table = 'agenda_app';
	protected $primaryKey = 'id_agenda';
	
	public function getAdmin()
	{
	return $this->belongsTo('App\Models\User', 'user_id');
	}
}
