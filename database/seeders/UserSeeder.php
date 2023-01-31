<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'ros',
            'password' => Hash::make('123123')
        ]);
        DB::table('users')->insert( [
            'username' => 'edp',
            'password' => Hash::make('edpsip')
        ]);

        // User::create();
    }
}
