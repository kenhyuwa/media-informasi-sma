<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanApp extends Model
{
    protected $table = 'pesan_app';
	protected $primaryKey = 'id_pesan';
	public $timestamps =false;
	protected $fillable = ['username,email,pesan'];
}
