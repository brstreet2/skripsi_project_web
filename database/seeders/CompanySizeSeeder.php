<?php

namespace Database\Seeders;

use App\Models\CompanySize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanySize::insert([
            [
                'size'          => '1 - 4',
                'value_min'     => 1,
                'value_max'     => 4
            ],
            [
                'size'          => '5 - 19',
                'value_min'     => 5,
                'value_max'     => 19
            ],
            [
                'size'          => '20 - 99',
                'value_min'     => 20,
                'value_max'     => 99
            ],
        ]);
    }
}
