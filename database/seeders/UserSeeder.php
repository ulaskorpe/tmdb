<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->email= 'ulaskorpe@gmail.com';
        $user->admin_code= 130000;
        $user->name= 'ulaş körpe';
        $user->password= Hash::make('secret');
        $user->save();

       
    }
}
