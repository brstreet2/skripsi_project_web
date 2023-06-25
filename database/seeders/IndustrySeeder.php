<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Industry::insert([
            [
                'name' => 'Pertanian'
            ],
            [
                'name' => 'Peternakan'
            ],
            [
                'name' => 'Perikanan'
            ],
            [
                'name' => 'Pertambangan & Penggalian'
            ],
            [
                'name' => 'Industri Pengolahan'
            ],
            [
                'name' => 'Makanan/Minuman'
            ],
            [
                'name' => 'Fashion'
            ],
            [
                'name' => 'Handycraft'
            ],
            [
                'name' => 'Listrik, Air dan Gas'
            ],
            [
                'name' => 'Bangunan'
            ],
            [
                'name' => 'Perdagangan dan Reparasi'
            ],
            [
                'name' => 'Transportasi Pergudangan dan Komunikasi'
            ],
            [
                'name' => 'Persewaan dan Kontraktor'
            ],
            [
                'name' => 'Perantara Keuangan'
            ],
            [
                'name' => 'Jasa'
            ],
            [
                'name' => 'Kegiatan Lainnya'
            ],
            [
                'name' => 'Akomodasi dan Penyediaan Makanan Minuman'
            ],
            [
                'name' => 'Jasa Pendidikan dan Pelayanan RT'
            ],
            [
                'name' => 'Jasa Kesehatan dan Kegiatan Sosial'
            ],
            [
                'name' => 'Konstruksi'
            ],
            [
                'name' => 'Perorangan'
            ],
        ]);
    }
}
