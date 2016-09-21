<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuFrontApp extends Model
{
	protected $table      = 'menu_front_app';
	protected $primaryKey = 'id_menu';
	public $timestamps    = false;
	public $incrementing = false;

}
