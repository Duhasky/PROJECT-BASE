<?php

namespace Database\Seeders;

use App\Models\{Ability, User};
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $user = User::create([
            'name'              => 'master',
            'user_name'         => 'master',
            'regist_number'     => '00000001',
            'email'             => 'master@admin.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('admin'),
            'remember_token'    => Str::random(10),
        ]);

        $role = $user->roles()->create([
            'name'      => 'master',
            'hierarchy' => 0,
        ]);

        $role->abilities()->createMany([
            ['name' => 'admin'],
            ['name' => 'user_create'],
            ['name' => 'user_read'],
            ['name' => 'user_update'],
            ['name' => 'user_delete'],
            ['name' => 'city_create'],
            ['name' => 'city_read'],
            ['name' => 'city_update'],
            ['name' => 'city_delete'],
            ['name' => 'group_create'],
            ['name' => 'group_read'],
            ['name' => 'group_update'],
            ['name' => 'group_delete'],
            ['name' => 'people_create'],
            ['name' => 'people_read'],
            ['name' => 'people_update'],
            ['name' => 'people_delete'],
            ['name' => 'photo_delete'],
        ]);

        $user = User::create([
            'name'              => 'admin',
            'user_name'         => 'admin',
            'regist_number'     => '00000000',
            'email'             => 'admin@admin.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('admin'),
            'remember_token'    => Str::random(10),
        ]);

        $role = $user->roles()->create([
            'name'      => 'admin',
            'hierarchy' => 1,
        ]);

        $role->abilities()->sync(Ability::pluck('id')->toArray());
    }
}