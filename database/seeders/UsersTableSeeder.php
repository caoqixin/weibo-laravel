<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(100)->create();

        $user = User::find(1);
        $user->name = 'php';
        $user->email = 'php@qq.com';
        $user->is_admin = true;
        $user->save();
    }
}
