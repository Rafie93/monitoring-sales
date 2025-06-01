<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $cities = ['Banjarmasin','Banjarbaru'];

        foreach (range(1, 30) as $index) {
            $city = $faker->randomElement($cities);
            $nik = $faker->nik ?? sprintf(
                '%02d%02d%02d%s%04d',
                63,
                $faker->numberBetween(71, 72),
                $faker->numberBetween(10, 30),
                $faker->date('dmy'),
                $faker->numberBetween(1, 9999)
            );
            $npwp = sprintf(
                '%02d.%03d.%03d.%d-%03d.%03d',
                $faker->numberBetween(1, 34),
                $faker->numberBetween(0, 999),
                $faker->numberBetween(0, 999),
                $faker->numberBetween(0, 9),
                $faker->numberBetween(0, 999),
                $faker->numberBetween(0, 999)
            );
            // $address =$faker->streetAddress ;//$faker->streetAddressByCity($city);
            $address = "Jl. A.Yani Km ".$faker->numberBetween(3,33)." No ".$faker->numberBetween(1,100).", ".$city;
            $phoneNumber = '08' . $faker->numerify('##########'); 
            $phoneNumber = $faker->regexify('08[0-9]{10}');
            Customer::create([
                'nama' => $faker->name,
                'jenis_identitas'=> 'KTP', 
                'no_identitas'=> $nik,
                'no_npwp' => $npwp, 
                'alamat_ktp' => $address,
                'alamat_domisili' =>$address,
                'email' => $faker->email, 
                'no_hp' => $phoneNumber,
                'pekerjaan' => $faker->jobTitle
            ]);
        }
    }
}
