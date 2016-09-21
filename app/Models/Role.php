<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $table = 'role_app';
	public $timestamps = 'false';

    public function user()
    {
    	return $this->belongsToMany(User::class);
    }
}
