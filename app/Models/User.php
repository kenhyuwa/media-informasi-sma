<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'guru_app';
    protected $primaryKey ='id_guru';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nip','nama_guru','tempat_lahir','alamat','gender','agama','jabatan','pdd_akhir'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function assignRole($role)
    {
        if (is_string($role))
        {
            $role = Role::where('nama_role', $role)->first();
        }
        return $this->roles()->attach($role);
    }

    public function revokeRole($role)
    {
        if (is_string($role))
        {
            $role = Role::where('nama_role', $role)->first();
        }
        return $this->roles()->detach($role);
    }

    public function hasRole($nama)
    {
        foreach ($this->roles as $role)
        {
            if ($role->nama_role === $nama) return true;
        }
            return false;
    }

    public function setWaliKelas()
    {
        return $this->belongsToMany('App\Models\KelasApp','guru_id','id_guru');
    }

    public function setAuthor()
    {
        return $this->belongsTo('App\Models\DownloadApp');
    }
}
