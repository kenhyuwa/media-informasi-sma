<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory('App\Models\User')->create([
    			'username' => 'wahyu',
    			//'email' => 'admin@gmail.com',
    			'password' => bcrypt('admin88')
    			]);

        factory('App\Models\User')->create([
                'username' => 'bidadari',
                //'email' => 'guru@gmail.com',
                'password' => bcrypt('bidadari')
                ]);
        factory('App\Models\Role')->create([
                'nama_role' => 'administrator'
                ]);

        factory('App\Models\Role')->create([
                'nama_role' => 'guru'
                ]);
        factory('App\Models\MenuApp')->create([
                'nama_menu' => 'management system',
                'link_menu' => 'menu',
                'icon_menu' => 'fa fa-spin fa-refresh',
                'is_aktiv' => '1',
                'parent_menu' => '0',
                'hak_akses' => '1',
                ]);
    }
}
