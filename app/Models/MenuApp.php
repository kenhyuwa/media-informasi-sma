<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuApp extends Model
{
    protected $table = 'menu_back_app';
    public $timestamps = false;
    protected $fillable =['nama_menu','link_menu','icon_menu','is_aktiv','parent_menu','hak_akses'];

    public function menu()
    {
    	$menu_apps = MenuApp::orderBy('id', 'desc')
                                ->where('parent_menu', '0')
                                ->get();
        return $menu_apps;
    }
}
