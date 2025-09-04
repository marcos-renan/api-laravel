<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!User::where('email', 'marcos@email.com')->first()){
            User::create([
                'name'=>'Marcos',
                'email'=>'marcos@email.com',
                'password'=> Hash::make('123456', ['rounds'=>12]),
            ]);
        }
        if (!User::where('email', 'renan@email.com')->first()) {
            User::create([
                'name' => 'Renan',
                'email' => 'renan@email.com',
                'password' => Hash::make('123456', ['rounds' => 12]),
            ]);
        }
        if (!User::where('email', 'oliver@email.com')->first()) {
            User::create([
                'name' => 'Oliver',
                'email' => 'oliver@email.com',
                'password' => Hash::make('123456', ['rounds' => 12]),
            ]);
        }
        if (!User::where('email', 'silva@email.com')->first()) {
            User::create([
                'name' => 'Silva',
                'email' => 'silva@email.com',
                'password' => Hash::make('123456', ['rounds' => 12]),
            ]);
        }
    }
}
