<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\Sales;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AbsensiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $salesman = Sales::pluck('id_sales');
        $startDate = Carbon::now()->subMonths(2)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        foreach ($salesman as $sales) {
            $currentDate = clone $startDate;
            // Loop melalui setiap hari dalam rentang 2 bulan
            while ($currentDate <= $endDate) {
                // Skip weekend (Sabtu dan Minggu)
                if (!$currentDate->isWeekend()) {
                    // Data absensi masuk
                    $clockIn = $currentDate->copy()->setTime(
                        $faker->numberBetween(7, 9), // Jam 7-9
                        $faker->numberBetween(0, 59)
                    );
                    
                    // Data absensi pulang (8-9 jam setelah masuk)
                    $clockOut = $clockIn->copy()->addHours(
                        $faker->numberBetween(8, 9)
                    )->addMinutes($faker->numberBetween(0, 59));
                    
                    // Status kehadiran (90% Hadir, 5% Telat, 5% Alpha)
                    $status = $faker->randomElement([
                        'Hadir' => 'Hadir',
                        'Telat' => 'Telat',
                        'Alpha' => 'Alpha'
                    ]);
                    
                    // Jika status Alpha, tidak ada jam masuk/pulang
                    if ($status === 'Alpha') {
                        $clockIn = null;
                        $clockOut = null;
                    }else{
                        Absensi::create([
                            'id_sales' => $sales,
                            'tanggal' => $currentDate->format('Y-m-d'),
                            'jam_masuk' => $clockIn ? $clockIn->format('H:i:s') : null,
                            'jam_keluar' => $clockOut ? $clockOut->format('H:i:s') : null,
                            'status' => $status,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                    
                  
                }
                
                // Tambah 1 hari
                $currentDate->addDay();
            }
        }
    }
}
