<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
	protected $table = 'role_user';
	protected $primaryKey = 'user_id';
	public $timestamps = 'false';
	
    public function user()
    {
    	return $this->belongsToMany(User::class);
    }
    public function getUser()
    {
    	return $this->belongsTo('App\Models\User','user_id');
    }
    public function getRole()
    {
        return $this->belongsTo('App\Models\Role','role_id');
    }
}
