<?php

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'admin',
            'slug' => 'Администратор',
        ]);

        $user = User::create([
            'name'              => 'admin',
            'email'             => 'admin@admin.ru',
            'images'            => 'https://cdn.vuetifyjs.com/images/profiles/marcus.jpg',
            'email_verified_at' => now(),
            'password'          => Hash::make('admin'),
            'remember_token'    => Str::random(10),
        ]);

        $user->roles()->save($role);

        factory(User::class, 19)->create();
    }
}
