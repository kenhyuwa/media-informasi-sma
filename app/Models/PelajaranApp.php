<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelajaranApp extends Model
{
    protected $table = 'pelajaran_app';
    protected $primaryKey = 'id_matpel';
    public $timestamps = false;
}
