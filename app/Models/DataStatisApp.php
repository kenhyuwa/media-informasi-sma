<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataStatisApp extends Model
{
   protected $table = 'data_statis_app';
   protected $primaryKey = 'id_data';
   public $timestamps = false;

   public function getMenuFront()
   {
   	return $this->belongsTo('App\Models\MenuFrontApp', 'menu_id');
   }
}
