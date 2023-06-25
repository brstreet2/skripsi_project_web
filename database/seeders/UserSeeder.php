<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $token = encrypt(\rand(1, 99) . "^_^" . Carbon::now()->format("Y-m-d H:i:s"));

        $data = [
            'name'       => "Root",
            'email'      => "root@admin.com",
            'password'   => "Password123",
            'phone'      => '08189890000',
            'token'      => $token,
        ];

        //Create a new user and activated that users
        $user = Sentinel::registerAndActivate($data);
    }
}
