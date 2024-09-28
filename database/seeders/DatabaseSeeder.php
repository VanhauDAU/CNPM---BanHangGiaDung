<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('taikhoan')->insert([
            'username'=>'admin1',
            'email'=>'levanhau102001@gmail.com',
            'loai_tai_khoan'=>1,
            'password'=>Hash::make('1234')
        ]);
    }
}
